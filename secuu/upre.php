<?
require_once("../setting.php");
require_once("../define.php");
require_once("../advertise-setting.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Secure Share - <? echo SITENAME; ?></title>
<?
$pass = $_POST["pwedit"];
$repass = $_POST["pwedit2"];
$pass= $_POST["pwdown"];
$pwdown2 = $_POST["pwdown2"];
if ($pass == ""){
	header("Location: upload.php?eid=npw");
	//No PassWord
}
if (basename($_FILES['fileToUpload']['name']) == "" ){
	header("Location: upload.php?eid=nfs");
	//No File Selected
}
if ($repass == ""){
header("Location: upload.php?eid=npw");
}
if ($pass == $repass){}else{
header("Location: upload.php?eid=pns");
}
if ($pass== ""){
header("Location: upload.php?eid=npw");
}
if ($pwdown2 == $pwdown){}else{
header("Location: upload.php?eid=pns");
}

            
$folder = '../file/Secure';
$counter = (count(glob("$folder/*",GLOB_ONLYDIR))) + 1; //I found very FATAL Bug in get how many folder in directory.=>
//Though there are no folders but it returns 1. So There is a directory for prevent unexpected situation.

	mkdir('../file/Secure/'.$counter);
	mkdir('../file/Secure/'.$counter.'/secure');


    $uploaddir = '../file/Secure/'.$counter.'/secure/';
	$uploadfile = $uploaddir . $_FILES['fileToUpload']['name'];
if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadfile)){
}
else
{
	echo "<h1>Secure Share - ".SITENAME."</h1><h3>Failed to move uploaded file from cache directory to real directory!</h3>";
	exit();
}

$pass= filename_hash($pwdown); //Use for all hasing method.         

$fileinfo = pathinfo('../file/Secure/'.$counter.'/secure/'.$_FILES['fileToUpload']['name']);

rename('../file/Secure/'.$counter.'/secure/'.$_FILES['fileToUpload']['name'], '../file/Secure/'.$counter.'/secure/'.$pass);

$redirection = "<?php header('Location: ../../../s/".$counter."');"; //Redirect File.
$file = fopen('../file/Secure/'.$counter.'/index.php', 'w');
fwrite($file, $redirection);
fclose($file);


$file = fopen('../file/Secure/'.$counter.'/secure/downpw.txt', 'w'); //Save Password (Hashed) for download
fwrite($file, $pwdown);
fclose($file);

$file = fopen('../file/Secure/'.$counter.'/secure/filename.txt', 'w'); //Save file name
fwrite($file, $_FILES['fileToUpload']['name']);
fclose($file);


$file = fopen('../file/Secure/'.$counter.'/secure/ip.txt', 'w'); //Save user IP Address
fwrite($file, get_ip());
fclose($file);

$file = fopen('../file/Secure/'.$counter.'/secure/.htaccess', 'w'); //To prevent Webshell Attack
fwrite($file, "order deny,allow        
deny from all");
fclose($file);


$file = fopen('../file/Secure/'.$counter.'/count.txt', 'w'); //Download Counter File
fwrite($file, "0");
fclose($file);


$ext = $fileinfo['extension'];
$file = fopen('../file/Secure/'.$counter.'/extension.txt', 'w'); //File extension
fwrite($file, $ext);
fclose($file);



//Save Password(Hashed) for delete
$file = fopen('../file/Secure/'.$counter.'/secure/pw.txt', 'w');
fwrite($file, filename_hash());
fclose($file);

//Success Page
echo '<h1>'.SITENAME.' - Secure Share</h1><br><h2>Upload Completed! Here is some information of uploaded file.</h2><br><br><h3>Filen Name: '.basename($_FILES['fileToUpload']['name']).'<br>Link: <a href="'.SITEADDR.'/s/'.$counter.'" target="_blank">'.SITEADDR.'/s/'.$counter.'</a><br>Password(for delete): '.$pass.'<br>password(for download): '.$pwdown.'<br>Link(Delete File): <a href="'.SITEADDR.'/dels/" target="_blank">http://gnlshare.wink.ws/dels/</a><br><br> <input type="button" value="Upload More File!(Secure)" onclick="location.href=&#39'.SITEADDR.'/secuu/upload.php&#39">';            
         } else {
          echo "<h1>".SITENAME." - Secure Share</h1><br><h2>Failed to Upload Your File... Please try again!</h2>";
     }