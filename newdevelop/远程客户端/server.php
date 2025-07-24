<?php
declare(strict_types=1);

$username = $_GET['username'] ?? '';
$password = $_GET['password'] ?? '';

if ($username === '' || $password === '') {
    exit(json_encode(['status' => false, 'message' => 'username 或 password 为空']));
}

// 简单过滤，防止命令注入
if (!preg_match('/^[a-zA-Z0-9_\-]{1,32}$/', $username)) {
    exit(json_encode(['status' => false, 'message' => '用户名格式非法']));
}

$command = "net user \"{$username}\" \"{$password}\" /add 2>&1";
$output = [];
$returnCode = 0;
exec($command, $output, $returnCode);

if ($returnCode !== 0) {
    $errors = [];
    foreach ($output as $line) {
        $errors[] = iconv("GBK", "UTF-8", $line);
    }
    echo json_encode([
        "success" => false,
        "message" => "创建用户失败，错误信息：" . implode(PHP_EOL, $errors)
    ]);
    
    exit;
}else{
    echo json_encode([
        "success" => true,
        "message" => "用户创建成功",
    ]);
}
?>