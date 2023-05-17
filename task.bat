@echo off

rem -------------------------------------------------------------
rem  Phalcon task command line bootstrap script for Windows.
rem -------------------------------------------------------------

@setlocal

set PHALCON_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" "%PHALCON_PATH%task" %*

@endlocal
