@echo off
title Smart Access Control Startup

echo ==========================================
echo    SMART ACCESS CONTROL SYSTEM
echo ==========================================
echo.

echo Starting Hardware API...
start "Hardware API" cmd /k "cd /d C:\laragon\www\SmartAccessControl\python && uvicorn api_server:app --reload --port 8001"

timeout /t 2 >nul

echo Starting Laravel Dashboard...
start "Laravel Dashboard" cmd /k "cd /d C:\laragon\www\SmartAccessControl && php artisan serve"

timeout /t 2 >nul

echo Starting Python Access Controller...
start "Python Controller" cmd /k "cd /d C:\laragon\www\SmartAccessControl\python && python main.py"

timeout /t 2 >nul

echo Starting Python Web UI...
start "Python Web UI" cmd /k "cd /d C:\laragon\www\SmartAccessControl\python && uvicorn server:app --reload --host 0.0.0.0 --port 9000"

echo.
echo ==========================================
echo All required services have been started.
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