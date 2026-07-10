@echo off
title Smart Access Control Startup

echo ==========================================
echo      SMART ACCESS CONTROL SYSTEM
echo ==========================================
echo.

echo [1/3] Starting Laravel Dashboard...
start "Laravel Dashboard" cmd /k "cd /d C:\laragon\www\SmartAccessControl && php artisan serve"

timeout /t 2 >nul

echo [2/3] Starting Hardware API...
start "Hardware API" cmd /k "cd /d C:\laragon\www\SmartAccessControl\python && uvicorn api_server:app --reload --port 8001"

timeout /t 2 >nul

echo [3/3] Starting Python Web UI...
start "Python Web UI" cmd /k "cd /d C:\laragon\www\SmartAccessControl\python && uvicorn server:app --reload --host 0.0.0.0 --port 9000"

timeout /t 2 >nul

echo.
echo ==========================================
echo      ALL SERVICES STARTED SUCCESSFULLY
echo ==========================================
echo.

echo Laravel Dashboard:
echo http://127.0.0.1:8000
echo.

echo Hardware API:
echo http://127.0.0.1:8001/docs
echo.

echo Python Web UI:
echo http://127.0.0.1:9000
echo.

pause