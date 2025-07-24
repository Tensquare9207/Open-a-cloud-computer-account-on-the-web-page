<?php
session_start();

header('Content-Type: application/json');
$origin =$_SERVER['HTTP_ORIGIN'] ?? '';

// 允许的来源列表
$allowedOrigins = [
    'https://www.ltyun.top',
    'https://ltyun.top',
    'https://hm.2b2t.ren'
];

// 检查请求的来源是否在允许的来源列表中
if (in_array($origin,$allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
}

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST'); // 允许的HTTP方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的HTTP头部

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username =$_POST['username'];
    $password =$_POST['password'];

    $email =$_POST['email'];
    $QQ =$_POST['QQ'];
    
  
    
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => '用户名或密码不能为空']);
        exit;
    }

    if (mb_strlen($username, 'UTF-8') > 10) {
        echo json_encode(['success' => false, 'message' => '用户名不能超过10个字符']);
        exit;
    }
      
    
    if (strpos($username, 'admin') !== false || strpos($username, 'root') !== false || strpos($username, 'administrator') !== false || strpos($username, 'Administrator') !== false) {
        echo json_encode(['success' => false, 'message' => '用户名包含非法字符']);
        exit;
    }

    $file = './sql/user.txt';
    if (file_exists($file)) {
        $lines = file($file);
        $existingEmails = [];
        $existingQQs = [];
        foreach ($lines as$line) {
            $data = explode(',',$line);
            $existingEmails[] = trim($data[3]);
            $existingQQs[] = trim($data[5]);
        }

        if (in_array($email,$existingEmails)) {
            echo json_encode(['success' => false, 'message' => '邮箱已存在']);
            exit;
        }

        if (in_array($QQ,$existingQQs)) {
            echo json_encode(['success' => false, 'message' => 'QQ号已存在']);
            exit;
        }
    }

    $id = 1;
    if (file_exists($file)) {
        $lines = file($file);
        $lastLine = end($lines);
        if ($lastLine) {
            $lastData = explode(',',$lastLine);
            $id = (int)$lastData[0] + 1;
        }
    }

    $command = "net user \"$username\" \"$password\" /add 2>&1";
    $output = [];
    $return_var = 0;
    exec($command,$output, $return_var);

    if ($return_var === 0) {
        $user_ip =$_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
        $userData = "$id,$username,$password,$email,$user_ip,$QQ;\n";
        file_put_contents('./sql/user.txt', $userData, FILE_APPEND | LOCK_EX);
        echo json_encode(['success' => true, 'message' => '用户创建成功']);
    } else {
        $errorMessages = [];
        foreach ($output as$line) {
            $errorMessages[] = iconv('GBK', 'UTF-8',$line);
        }
        echo json_encode(['success' => false, 'message' => '创建用户失败，错误信息：' . implode(PHP_EOL, $errorMessages)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => '无效的请求方法']);
}
?>
