@echo off
title Smart Access Control Shutdown

echo ==========================================
echo   STOPPING SMART ACCESS CONTROL SYSTEM
echo ==========================================
echo.

echo Stopping Uvicorn Servers...
taskkill /F /FI "WINDOWTITLE eq Hardware API*" >nul 2>&1
taskkill /F /FI "WINDOWTITLE eq Python Web UI*" >nul 2>&1

echo Stopping Laravel Server...
taskkill /F /FI "WINDOWTITLE eq Laravel Dashboard*" >nul 2>&1

echo Stopping Python Controller...
taskkill /F /FI "WINDOWTITLE eq Python Controller*" >nul 2>&1

echo.

echo ==========================================
echo All Smart Access Control services stopped.
echo ==========================================
pause