<head>
<meta charset="UTF-8">
<title>파일 삭제 - GnL(R) Share</title>
</head>
<?php

$var = $_POST["fid"];
if ($var == ""){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/admin-tools/index.php?i=1");
exit();
}
if(!is_dir("../file/".$var)){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/admin-tools/index.php?i=2");
}else{
if (!file_exists("../file/".$var."/pw.txt")){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/admin-tools/index.php?i=4");
exit();
}
$fp = fopen("../file/".$var."/pw.txt","r");
$fr = fread($fp, filesize("../file/".$var."/pw.txt"));
fclose($fp);

//key is CF46096EB003A0BCB6062934E0208363F414837E
$newtext = sha1($pw);

rrmdir("../file/".$var."/gnl_localservicesStorage");

unlink("../file/".$var."/down.txt");
unlink("../file/".$var."/pw.txt");
unlink("../file/".$var."/uploaderid.txt");
unlink("../file/".$var."/sha1.txt");
unlink("../file/".$var."/md5.txt");
unlink("../file/".$var."/ext.txt");

$filerr = fopen('../file/'.$var.'/index.php', 'w');
fwrite($filerr, "<? header('Location: http://www.gnlshare.wink.ws/info/filedeleted.php'); ?> ");
fclose($filerr);

 $filerr = fopen('../file/'.$var.'/fname.txt', 'w');
fwrite($filerr, "DEL");
fclose($filerr);
echo "<h1>GnL(R) Share Admin-Tools(보안): Enforcing File Delete</h1><h3>파일 강제 삭제에 성공하였습니다!</h3>";

}

function encrypt($string, $key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }
  return base64_encode($result);
}


function decrypt($string, $key) {
  $result = '';
  $string = base64_decode($string);
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }
  return $result;
}


function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           rrmdir($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 }

?>