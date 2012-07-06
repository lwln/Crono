@echo off
:restart
color 18
set php=c:/php/php.exe
%php% router.php
color 81
pause
CLS
goto restart