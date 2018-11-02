@echo off

echo.
git add .
echo * Status of you project
git status

echo.

choice /C yn /M "Commit and push ? y(yes)/n(no) ?"
if errorlevel 2 goto end
if errorlevel 1 goto push

:push
echo.
echo * Commit files...
git commit -a -m "%1 - commit by bat"
echo.
echo * Push Files...
git push origin master
echo.

:end
exit