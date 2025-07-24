<?php
session_start();

header('Content-Type: application/json');

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// 允许的来源列表
$allowedOrigins = [
    'https://www.ltyun.top',
    'https://ltyun.top',
    'https://hm.2b2t.ren'
];

// 检查请求的来源是否在允许的来源列表中
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
}

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST'); // 允许的HTTP方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的HTTP头部

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $QQ = filter_input(INPUT_POST, 'QQ', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => '用户名或密码不能为空']);
        exit;
    }

    if (mb_strlen($username, 'UTF-8') > 10) {
        echo json_encode(['success' => false, 'message' => '用户名不能超过10个字符']);
        exit;
    }

    if (preg_match('/admin|root|administrator|Administrator/i', $username)) {
        echo json_encode(['success' => false, 'message' => '用户名包含非法字符']);
        exit;
    }

    $file = './sql/user.txt';
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $existingEmails = [];
        $existingQQs = [];
        foreach ($lines as $line) {
            $data = explode(',', $line);
            if (count($data) >= 6) {
                $existingEmails[] = trim($data[3]);
                $existingQQs[] = trim($data[5]);
            }
        }

        if (in_array($email, $existingEmails)) {
            echo json_encode(['success' => false, 'message' => '邮箱已存在']);
            exit;
        }

        if (in_array($QQ, $existingQQs)) {
            echo json_encode(['success' => false, 'message' => 'QQ号已存在']);
            exit;
        }
    }

    $id = 1;
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines) {
            $lastLine = end($lines);
            $lastData = explode(',', $lastLine);
            $id = (int)$lastData[0] + 1;
        }
    }

    $batFile = 'create_user.bat';
    $command = "cmd.exe /c \"$batFile\" \"$username\" \"$password\"";
    $output = [];
    $return_var = 0;
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
        $userData = "$id,$username,$password,$email,$user_ip,$QQ;\n";
        file_put_contents('./sql/user.txt', $userData, FILE_APPEND | LOCK_EX);
        echo json_encode(['success' => true, 'message' => '用户创建成功']);
    } else {
        $errorMessages = implode(PHP_EOL, $output);
        echo json_encode(['success' => false, 'message' => '创建用户失败，错误信息：' . $errorMessages]);
    }
} else {
    echo json_encode(['success' => false, 'message' => '无效的请求方法']);
}
?>
