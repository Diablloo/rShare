<head>
<meta charset="UTF-8">
<title>파일 삭제 - GnLS-Secure(R)</title>
</head>
<?php
$pw = $_POST["pwyo"];
$var = $_POST["fid"];
if ($var == ""){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/dels/index.php?i=1");
exit();
}elseif($pw == ""){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/dels/index.php?i=1");
}
if(!is_dir("../file/GnLS-Secure/".$var)){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/dels/index.php?i=2");
}else{
if (!file_exists("../file/GnLS-Secure/".$var."/gnl_localservicesStorage/pw.txt")){
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/dels/index.php?i=4");
exit();
}
$fp = fopen("../file/GnLS-Secure/".$var."/gnl_localservicesStorage/pw.txt","r");
$realps = fread($fp, filesize("../file/GnLS-Secure/".$var."/gnl_localservicesStorage/pw.txt"));
fclose($fp);

//key is CF46096EB003A0BCB6062934E0208363F414837E

if (sha1(sha1($pw))== $realps) {
rrmdir("../file/GnLS-Secure/".$var."/gnl_localservicesStorage");

unlink("../file/GnLS-Secure/".$var."/down.txt");


unlink("../file/GnLS-Secure/".$var."/sha1.txt");
unlink("../file/GnLS-Secure/".$var."/md5.txt");
unlink("../file/GnLS-Secure/".$var."/ext.txt");

$filerr = fopen('../file/GnLS-Secure/'.$var.'/index.php', 'w');
fwrite($filerr, "<? header('Location: http://www.gnlshare.wink.ws/info/filedeleted.php'); ?> ");
fclose($filerr);

 $filerr = fopen('../file/GnLS-Secure/'.$var.'/fname.txt', 'w');
fwrite($filerr, "DEL");
fclose($filerr);

echo "<h1>GnLS-Secure(R) by GnL(R) Share</h1><br><h3>파일 삭제에 성공하였습니다!</h3>";
} else {
echo "<h1>GnLS-Secure(R) by GnL(R) Share</h1><h3>파일을 삭제할 수 없습니다: 올바르지 않은 비밀번호</h3>";
echo 'NOT FOUND 404';
header("Location: http://www.gnlshare.wink.ws/dels/index.php?i=3");
}
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