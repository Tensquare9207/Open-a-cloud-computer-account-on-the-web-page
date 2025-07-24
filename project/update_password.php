<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email =$_POST['email'] ?? '';
    $password =$_POST['password'] ?? '';
    $code =$_POST['code'] ?? '';
    $username =$_POST['username'] ?? ''; 
    $sentCode =$_SESSION['verification_code_email'] ?? ''; 
    $captcha =$_POST['captcha'] ?? '';

    if (strtolower($captcha) !== strtolower($_SESSION['captcha'] ?? '')) {
        echo json_encode(['success' => false, 'message' => '验证码错误']);
        exit;
    }
    
    if ($code !==$sentCode) {
        echo json_encode(['status' => 'error', 'message' => '验证码无效。']);
        exit;
    }

    $users = file_get_contents('./sql/user.txt');
    $lines = explode(';', trim($users)); // 使用分号分割行

    $emailMatched = false;
    foreach ($lines as$line) {
        $line = trim($line); 
        if (!empty($line)) { // 确保行不为空
            $user = explode(',',$line); // 使用逗号分割字段
            
            // 打印每一行的解析情况
            file_put_contents('./logs/user_file_content.log', "Parsed line: " . print_r($user, true) . "\n", FILE_APPEND);
            
            // 检查用户数据格式是否正确
            if (count($user) === 6) {
                $currentUsername = trim($user[1]); 
                $currentEmail = trim($user[3]);
                
                // 比较用户名和邮箱，忽略大小写
                if (strcasecmp($currentUsername,$username) === 0 && strcasecmp($currentEmail,$email) === 0) {
                    $emailMatched = true;
                    break;
                }
            }
        }
    }
    
    if (!$emailMatched) {
        // 如果没有匹配，记录调试信息
        $debug = "storedUsername:$currentUsername, inputUsername: $username, storedEmail:$currentEmail, inputEmail: $email";
        file_put_contents('./logs/password_change_errors.log', date('Y-m-d H:i:s') . " - " . $debug . PHP_EOL, FILE_APPEND);
        echo json_encode(['status' => 'error', 'message' => '用户名或邮箱不匹配。']);
        exit;
    }
    
    $checkUserExists = "net user " . escapeshellarg(iconv('UTF-8', 'GB2312//IGNORE',$username)) . " 2>nul";
    $exists = shell_exec($checkUserExists);
    if (empty($exists)) {
        $logMessage = date('Y-m-d H:i:s') . " - Windows 用户不存在。执行命令: \"$checkUserExists\"";
        file_put_contents('./logs/password_change_errors.log', $logMessage . PHP_EOL, FILE_APPEND);
        echo json_encode(['status' => 'error', 'message' => 'Windows 用户不存在。']);
        exit;
    }

    
    $updated = false;
    foreach ($lines as &$line) {
        $line = trim($line); 
        $user = explode(',',$line);
        if (count($user) === 6 && trim($user[1]) === $username && trim($user[3]) === $email) {
         
            $user[2] =$password;
            $line = implode(',',$user);
            $updated = true;
            break;
        }
    }
    unset($line); // 解除引用

    $newLines = [];
    foreach ($lines as$line) {
        $line = trim($line);
        if (!empty($line)) {
            $newLines[] =$line . ';';
        }
    }
    unset($line); // 再次解除引用
    if ($updated) {

        $batFilePath = __DIR__ . '/change_password.bat';
        if (!file_exists($batFilePath)) {
            echo json_encode(['status' => 'error', 'message' => '批处理文件不存在。']);
            exit;
        }
        $changePasswordCommand = "cmd /c \"$batFilePath\" $username $password";
        exec($changePasswordCommand,$output, $resultCode);
        
        $outputStr =$output ? implode(PHP_EOL, $output) : "No output from command.";
        if ($resultCode === 0) {
            // 检查是否包含成功消息，也可以检查文件change_password_output.txt的内容
            if (strpos($outputStr, 'Success:') !== false || file_exists('change_password_output.txt')) {
                $outputFromFile = file_get_contents('change_password_output.txt');
                if (strpos($outputFromFile, 'Success:') !== false) {
                    // 密码更新成功
                    if (empty(end($lines))) {
                        array_pop($lines);
                    }
                    file_put_contents('./sql/user.txt', implode(PHP_EOL, $newLines) . PHP_EOL);
                    echo json_encode(['status' => 'success', 'message' => '密码更新成功']);
                } else {
                    // 更新失败，记录日志
                    $logMessage = date('Y-m-d H:i:s') . " - Command failed with result code$resultCode. Output: $outputFromFile";
                    file_put_contents('./logs/password_change_errors.log', $logMessage . PHP_EOL, FILE_APPEND);
                    echo json_encode(['status' => 'error', 'message' => '无法更新密码,日志已保存！']);
                }
            } else {
                // 输出中不包含成功消息
                $logMessage = date('Y-m-d H:i:s') . " - Command executed successfully but output does not contain 'Success:'. Output:$outputStr";
                file_put_contents('./logs/password_change_errors.log', $logMessage . PHP_EOL, FILE_APPEND);
                echo json_encode(['status' => 'error', 'message' => '无法更新密码,日志已保存！']);
            }
        } else {
            // 命令执行失败
            $logMessage = date('Y-m-d H:i:s') . " - Command failed with result code$resultCode. Output: $outputStr";
            file_put_contents('./logs/password_change_errors.log', $logMessage . PHP_EOL, FILE_APPEND);
            echo json_encode(['status' => 'error', 'message' => '无法更新密码,日志已保存！']);
        }
    }        
} else {
    echo json_encode(['status' => 'error', 'message' => '请求方法无效。']);
}
?>
