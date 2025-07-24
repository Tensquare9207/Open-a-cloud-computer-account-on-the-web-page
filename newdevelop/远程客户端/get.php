<?php
declare(strict_types=1);
/**
 * 仅用于 CLI 模式
 * 把收集到的整包数据 POST 到上游
 */
ob_implicit_flush(true);
while (@ob_end_flush()) {}

$config      = require __DIR__ . '/config.php';
$upstreamUrl = $config['upstream'] ?? die('请在 config.php 中配置 upstream 地址' . PHP_EOL);

// 生成 / 读取 UID
$uidFile = __DIR__ . '/uid.txt';
if (!file_exists($uidFile)) {
    $uid = uniqid('srv_', true);
    file_put_contents($uidFile, $uid);
    echo "[+] 生成 UID {$uid}" . PHP_EOL;
} else {
    $uid = trim(file_get_contents($uidFile));
    echo "[+] 读取 UID {$uid}" . PHP_EOL;
}
date_default_timezone_set('Asia/Shanghai');
echo "[+] 服务器运行在 0.0.0.0:25565 ..." . PHP_EOL;
// ===== 业务循环 =====
while (true) {
    for ($i = 10; $i > 0; $i--) {
        echo "\r下一次更新在 {$i} 秒(s)...";
        sleep(1);
    }
    echo PHP_EOL;

    $now      = date('Y-m-d H:i:s');
    $hostname = gethostname();
    $ip       = gethostbyname($hostname);

    // 收集 7 段数据（函数 runPs 你原来就有）
    $payload = [
        'uid'              => $uid,
        'updata_time'      => $now,
        'server_name'      => $hostname,
        'server_ip'        => $ip,
        'server_data'      => runPs('Get-WmiObject -Class Win32_OperatingSystem | Select-Object @{Name=\'OSVersion\';Expression={$_.Version}},@{Name=\'OSArchitecture\';Expression={$_.OSArchitecture}},@{Name=\'OSName\';Expression={$_.Caption}},@{Name=\'ComputerName\';Expression={$env:COMPUTERNAME}},@{Name=\'Motherboard\';Expression={Get-WmiObject -Class Win32_BaseBoard | Select-Object -ExpandProperty Product}},@{Name=\'CPU\';Expression={Get-WmiObject -Class Win32_Processor | Select-Object -ExpandProperty Name}},@{Name=\'Memory\';Expression={Get-WmiObject -Class Win32_PhysicalMemory | Select-Object -ExpandProperty Description}} | ConvertTo-Json'),
        'server_cpu'       => runPs('[pscustomobject]@{\'ProcessorUsage\' = \'{0:N2}%\' -f (Get-Counter \'\\Processor(_Total)\\% Processor Time\' -MaxSamples 2).CounterSamples[-1].CookedValue} | ConvertTo-Json'),
        'server_memory'    => runPs('$os=Get-CimInstance Win32_OperatingSystem;[pscustomobject]@{FreePhysicalMemory=[math]::Round($os.FreePhysicalMemory/1MB,2);TotalVisibleMemorySize=[math]::Round($os.TotalVisibleMemorySize/1MB,2);UsedMemoryPercentage=\'{0:N2}%\' -f (100*(1-$os.FreePhysicalMemory/$os.TotalVisibleMemorySize))}|ConvertTo-Json'),
        'server_network'   => runPs('Get-NetAdapter | Where-Object { $_.Status -eq \'Up\' -and $_.Name -notmatch \'VMnet\' } | ForEach-Object { [PSCustomObject]@{ Name = $_.Name; Statistics = [PSCustomObject]@{ \'Upload(Mbps)\' = [math]::Round(( (Get-NetAdapterStatistics -Name $_.Name).SentBytes * 8 / 1MB ), 2); \'Download(Mbps)\' = [math]::Round(( (Get-NetAdapterStatistics -Name $_.Name).ReceivedBytes * 8 / 1MB ), 2) } } } | ConvertTo-Json'),
        'server_disk'      => runPs('[Console]::OutputEncoding=[Text.Encoding]::UTF8;$progressPreference=\'silentlyContinue\';try{$volumes=Get-Volume|Where{$_.DriveLetter-ne$null-and$_.Size-ge2GB}|ForEach-Object{$pct=if($_.Size-gt0){(($_.Size-$_.SizeRemaining)/$_.Size)*100}else{0};[PSCustomObject]@{DriveLetter=$_.DriveLetter.ToString();SizeGB=[math]::Round($_.Size/1GB,2);UsedGB=[math]::Round(($_.Size-$_.SizeRemaining)/1GB,2);UsagePercentage=(\'{0:N2}%\' -f $pct);DisplayName=(\'Drive {0}: Volume\' -f $_.DriveLetter);FileSystemLabel=if($_.FileSystemLabel){$_.FileSystemLabel}else{\'\'}}}|Sort-Object DriveLetter;$disks=Get-PhysicalDisk|Sort-Object DeviceId|ForEach-Object{[PSCustomObject]@{DeviceId=$_.DeviceId;SizeGB=[math]::Round($_.Size/1GB,2);MediaType=$_.MediaType.ToString();FriendlyName=$_.FriendlyName}};$totalSize=[math]::Round(($disks|Measure-Object -Property SizeGB -Sum).Sum,2);$totalUsed=[math]::Round(($volumes|Measure-Object -Property UsedGB -Sum).Sum,2);$totalPct=if($totalSize-gt0){\'{0:N2}%\' -f (($totalUsed/$totalSize)*100)}else{\'0%\'};[PSCustomObject]@{Volumes=@($volumes);TotalStorageSizeGB=$totalSize;TotalUsedGB=$totalUsed;TotalUsagePercentage=$totalPct;PerDiskSizes=@($disks)}|ConvertTo-Json -Depth 4}catch{[PSCustomObject]@{Error=$_.Exception.Message}|ConvertTo-Json}'),
        'server_task_list' => runPs('Get-Process | Select-Object Id,ProcessName,@{n=\'Memory\';e={[math]::Round($_.WorkingSet/1MB,2)}} | ConvertTo-Json -Depth 5'),
    ];

    // 发送 POST
    $ch = curl_init($upstreamUrl);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $resp = curl_exec($ch);
    $err  = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "[-] 提交失败：{$err}" . PHP_EOL;
    } else {
        $json = json_decode($resp, true);
        if (isset($json['success']) && $json['success']) {
            echo "[+] {$now} 提交成功：" . ($json['message'] ?? 'OK') . PHP_EOL;
        } else {
            echo "[-] {$now} 提交失败：" . ($json['message'] ?? $resp) . PHP_EOL;
        }
    }
}

// ===== 用来跑 PowerShell 的小工具 =====

// 运行 PowerShell 并返回 JSON 字符串
function runPs(string $script): string
{
    $escaped = addcslashes($script, '"');
    $cmd = "powershell -NoLogo -NoProfile -Command \"$escaped\"";
    $json = shell_exec($cmd);
    return trim($json) ?: '{}';
}
