<?
require_once("setting.php");
require_once("define.php")
?>
<head>
<meta charset="UTF-8">
<title>Not Found - 404</title>
</head>
<body>
<h1><? echo SITENAME; ?></h1>
<h2>404 - Page NOT FOUND</h2>
The page that you requested '
<?
echo $_SERVER['REQUEST_URI'];
?>
' Was not found on this server. Please check if the entered url's spell is wrong. Maybe the webpage has moved to another directory!
<br>
<?
showAD();
echo "<br>
<footer>
	".SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER."
	</footer>";
?>
</body>