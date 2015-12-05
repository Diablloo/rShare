<?
require_once("../setting.php");
require_once("../define.php");
require_once("../advertise-setting.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>File Upload (Normal Share) - <? echo SITENAME; ?></title>
<?
$pass = $_POST["pwedit"];
$repass = $_POST["pwedit2"];
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
//No 'password check'
}
if ($pass == $repass){}else{
header("Location: upload.php?eid=pns");
//Password Not same
}
            
$folder = '../file/';
$directories = (count(glob("$folder/*",GLOB_ONLYDIR))); 

mkdir('../file/'.$directories);
mkdir('../file/'.$directories.'/secure');

$uploaddir = '../file/'.$directories.'/secure/';
$uploadfile = $uploaddir . $_FILES['fileToUpload']['name'];
if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
                
          //Save file to Directory
          if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadfile)){
              //Succeed!!
          }else{
echo "<h1>Normal Share - ".SITENAME."</h1><h3>Failed to move uploaded file from cache directory to real directory!</h3>";
exit();
}
              
$fileinfo = pathinfo('../file/'.$directories.'/secure/'.$_FILES['fileToUpload']['name']);
$ext = $fileinfo['extension'];

$file_hash = filename_hash($_FILES['fileToUpload']['name']);
rename('../file/'.$directories.'/secure/'.$_FILES['fileToUpload']['name'], '../file/'.$directories.'/secure/'.$file_hash); //To prevent Webshell Attack

$hang = "<?php header('Location: ../../d/".$directories."');"; //Redirect Page
$file = fopen('../file/'.$directories.'/index.php', 'w');
fwrite($file, $hang);
fclose($file);
         

$file = fopen('../file/'.$directories.'/filename.txt', 'w'); //Save File Name
fwrite($file, $_FILES['fileToUpload']['name']);
fclose($file);

$file = fopen('../file/'.$directories.'/secure/ip.txt', 'w'); //Remote IP
fwrite($file, get_ip());
fclose($file);

$file = fopen('../file/'.$directories.'/secure/.htaccess', 'w'); //HTACCESS FILE (prevent access to file and values)
fwrite($file, "order deny,allow
deny from all
allow from 185.28.21.27
allow from ");
fclose($file);

$file = fopen('../file/'.$directories.'/count.txt', 'w'); //Download Counter
fwrite($file, "0");
fclose($file);

$file = fopen('../file/'.$directories.'/extension.txt', 'w'); //Extension File
fwrite($file, $ext);
fclose($file);


$file = fopen('../file/'.$directories.'/secure/pw.txt', 'w'); //Hashed Password
fwrite($file, $file_hash);
fclose($file);

//Done!
echo '<h1>'.SITENAME.' - Secure Share</h1><br><h2>Upload Completed! Here is some information of uploaded file.</h2><br><br><h3>Filen Name: '.basename($_FILES['fileToUpload']['name']).'<br>Link: <a href="'.SITEADDR.'/s/'.$directories.'" target="_blank">'.SITEADDR.'/s/'.$directories.'</a><br>Password(for delete): '.$pass.'<br>Link(Delete File): <a href="'.SITEADDR.'/del/" target="_blank">'.SITEADDR.'/del/</a><br><br> <input type="button" value="Upload More File!(Secure)" onclick="location.href=&#39'.SITEADDR.'/u/upload.php&#39">';               
         } else {
          echo "<h1>".SITENAME." - Secure Share</h1><br><h2>Failed to Upload Your File... Please try again!</h2>";
     }
	 showAD();
	 echo "<footer>
	".SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER."
	</footer>";