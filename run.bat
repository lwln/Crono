@echo off
:restart
color 18
set php=c:/php/php.exe
:starter
%php% router.php
IF EXIST tmp\restart (
	del tmp\restart
	goto starter
)
color 81
pause
CLS
goto restart