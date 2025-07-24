@echo off
SETLOCAL ENABLEDELAYEDEXPANSION

:: 参数
SET "username=%1"
SET "password=%2"

:: 日志文件路径
SET "logFile=creation_log.txt"

:: 创建用户
net user "%username%" "%password%" /add
IF %ERRORLEVEL% NEQ 0 (
    echo ERROR: Failed to create user %username%. >> %logFile%
    echo ERRORLEVEL: %ERRORLEVEL% >> %logFile%
    exit /b %ERRORLEVEL%
)

:: 输出成功信息
echo User %username% created successfully. >> %logFile%
EXIT /B 0
