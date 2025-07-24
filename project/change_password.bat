@echo off
:: 确保以管理员权限运行
>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"
if '%errorlevel%' NEQ '0' (
    echo Requesting Administrator privileges...
    powershell -Command "Start-Process '%~f0' -Verb RunAs"
    exit /b
)

:: 设置变量
set "username=%~1"
set "newpassword=%~2"

:: 尝试更改密码并捕获输出
net user "%username%" "%newpassword%" > change_password_output.txt 2>&1
set "result=%ERRORLEVEL%"

:: 检查命令执行结果
if %result% equ 0 (
    echo Success: Password changed for user %username%. Please verify.
) else (
    echo Error: Failed to change password for user %username%. Error code: %result%
    type change_password_output.txt
    exit /b %result%
)
