<?
require_once("../define.php");
require_once("../advertise-setting.php");
require_once("../setting.php");
?>
<head>
<meta charset="UTF-8">
<title>File Delete (Normal Share) - <? echo SITENAME; ?></title>
</head>
<?php
$pw = $_POST["pwyo"];
$file_id = $_POST["fid"];
if ($file_id == ""){
echo 'NOT FOUND 404';
header("Location: index.php?i=1");
}elseif($pw == ""){
echo 'NOT FOUND 404';
header("Location: index.php?i=1");
}
if(!is_file("../file/".$file_id."/secure/index.php")){
header("Location: index.php?i=2");
}else{
if (!file_exists("../file/".$file_id."/pw.txt")){;
header("Location: index.php?i=4");
exit();
}
$fp = fopen("../file/".$file_id."/pw.txt","r");
$fr = fread($fp, filesize("../file/".$file_id."/pw.txt"));
fclose($fp);

$s_key = filename_hash($pw);
if ($s_key == $fr) {

unlink("../file/".$file_id."/count.txt");
unlink("../file/".$file_id."/pw.txt");

unlink("../file/".$file_id."/extension.txt");

$filerr = fopen('../file/'.$file_id.'/index.php', 'w');
fwrite($filerr, "<h1>Sorry... File Deleted!</h1>");
fclose($filerr);

$filerr = fopen('../file/'.$file_id.'/secure/delete-reason.txt', 'w');
fwrite($filerr, "User Deleted");
fclose($filerr);

 $filerr = fopen('../file/'.$file_id.'/filename.txt', 'w');
fwrite($filerr, "File Not Found");
fclose($filerr);

echo "<h1>".SITENAME."</h1><br><h3>Succeed to Delete File!</h3>";
showAD();
} else {
header("Location: index.php?i=3");
}
}
?>