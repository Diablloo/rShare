<?
$SiteName = $_POST['sitename'];
$SiteAddress = $_POST['siteaddress'];
$AdminIPS = $_POST['adminip'];
$MaxUpSize = $_POST['maxupload'];
$MaxPostSize = $_POST['maxpost'];

$file = fopen("../setting.php", "w");
fwrite($file, "<? define('SITENAME', '".$SiteName."'); \n define('SITEADDR', ".$SiteAddress."');"); //In Windows System(IIS), Please change \n to \r\n
fclose($file);

$file = fopen("../admin-tools/.htaccess", "w");
fwrite($file, "deny from all \n  
allow from ".$AdminIPS); //In Windows System(IIS), Please change \n to \r\n
fclose($file);

$file = fopen("../.htaccess", "w");
fwrite($file, "php_value post_max_size ".$MaxPostSize."\n
php_value upload_max_filesize ".$MaxUpSize); //In Windows System(IIS), Please change \n to \r\n

echo "<h1>All Setting Generating Process Completed!</h1><h3>Now you may delete /install folder.</h3>";
echo "<h4>*You can edit adverise-setting.php to use advertise (Google Adsense)</h4>";
