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
    $lines = explode(PHP_EOL, trim($users)); 

    $emailMatched = false;
    foreach ($lines as$line) {
        $line = trim($line); 
        $user = explode(',',$line);
        
        if (count($user) === 6) {
            $storedUsername = trim($user[1]); 
            $storedEmail = trim($user[3]);
            
            if ($storedUsername ===$username && $storedEmail ===$email) {
                $emailMatched = true;
                break;
            }
        }
        
      
        $storedUsername = '';
        $storedEmail = '';
    }

    if (!$emailMatched) {
        $debug = "storedUsername:$storedUsername, inputUsername: $username, storedEmail:$storedEmail, inputEmail: $email";
        file_put_contents('./logs/password_change_errors.log', date('Y-m-d H:i:s') . " - " . $debug . PHP_EOL, FILE_APPEND);
        echo json_encode(['status' => 'error', 'message' => '用户名或邮箱不匹配。']);
        exit;
    }


    $checkUserExists = "net user " . escapeshellarg($username) . " 2>nul";
    $exists = shell_exec($checkUserExists);
    if (empty($exists)) {
        echo json_encode(['status' => 'error', 'message' => 'Windows 用户不存在。']);
        exit;
    }

    function is_admin() {
        return function_exists('shell_exec') && !empty(shell_exec('net session'));
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
  
    if ($updated) {
        $changePasswordCommand = "net user " . escapeshellarg($username) . " " . escapeshellarg($password);
        exec($changePasswordCommand,$output, $resultCode);
        if ($resultCode === 0) {
            if (empty(end($lines))) {
                array_pop($lines);
            }
         
          file_put_contents('./sql/user.txt', implode(PHP_EOL, $lines) . PHP_EOL);
            echo json_encode(['status' => 'success', 'message' => '密码更新成功']);
            $debug = "storedUsername:$storedUsername, inputUsername: $username, storedEmail:$storedEmail, inputEmail: $email";
            file_put_contents('./logs/password_change_errors.log', date('Y-m-d H:i:s') . " - " . $debug . PHP_EOL, FILE_APPEND);
        } else {
          
            $outputStr =$output ? implode(PHP_EOL, $output) : "No output from command.";
          
            $logMessage = date('Y-m-d H:i:s') . " - Command failed with result code$resultCode. Output: $outputStr";
            
            if (!is_admin()) {
                echo json_encode(['status' => 'error', 'message' => '脚本没有管理员权限，无法更改密码。请以管理员身份运行脚本。【提权实在是写不出来了也找不到】']);
                exit;
            }

            if (!function_exists('is_admin')) {
                function is_admin() {
                    return function_exists('shell_exec') && !empty(shell_exec('net session'));
                }
            }
            
            if (!is_admin()) {
                $logMessage .= PHP_EOL . "The script is not running with administrative privileges.";
            }
            
          
            file_put_contents('./logs/password_change_errors.log', $logMessage . PHP_EOL, FILE_APPEND);
            echo json_encode(['status' => 'error', 'message' => '无法更新密码,日志已保存！']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => '用户名不存在。']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => '请求方法无效。']);
}
?>
