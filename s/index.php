<head>
<meta charset="UTF-8">
<title>Password Check - <? echo SITENAME; ?></title>
</head>
<body>
<h1>Security Check before Download File - <? echo SITENAME; ?></h1>

<? 
$file_id = $_GET['file_id']; //File number
$errcode = $_GET['code']; //error code
?>
You have to verify that you have a right to download this file.
<br>
Please enter password(for download, not 'for delete'.)
<br>
<? if ($file_id == ""): ?>
NO SELECTED FILE NUMBER.
<h2>Please enter the file number & password to the given form!</h2>
<? elseif (!is_int($file_id)): ?>
<h2>File Number is NUMBER, not TEXT!!</h2>
Please enter the file number & password to the given form!
<? elseif(is_file("../file/Secure/".$file_id."/secure/delete-reason.txt")): ?>
<h2>File Deleted... Sorry for inconvenience...</h2>
Reason: 
<?
$fp = fopen("../file/Secure/".$file_id."/secure/delete-reason.txt");
$reason = fread($fp, filesize("../file/Secure/".$file_id."/secure/delete-reason.txt")); //read delete reason
if ($reason == "User Deleted"){
	
}
fclose($fp);
?>
<? else: ?>
<h2>Requested File Number: <? echo $file_id; ?></h2>
<h2>File Number: <? echo $file_id; ?></h2>
<? endif: ?> 
<?
$fr = "파일 존재하지 않음.";
if($istrue == 0){

}else{

if(!is_dir("../file/GnLS-Secure/".$file_id."/gnl_localservicesStorage")){
}
else{
$fp = fopen("../file/GnLS-Secure/".$file_id."/fname.txt","r");
$fr = fread($fp, filesize("../file/GnLS-Secure/".$file_id."/fname.txt"));
fclose($fp);
}
}
?>
<h2>파일 이름: <? echo $fr ?></h2><br><br>
<? if($istrue1 == 1){
echo '<form id="form1" enctype="multipart/form-data" method="post" action="move.php">';

    
 echo '비밀번호: <input type="password" name="pwedit" id="pwedit"/> <br> <input type="hidden" name="filestatus" value="true-enable-download"> <input type="hidden" name="file_id" value="'.$file_id.'"><br><br>';

    
   
   echo '<input type="submit" value="다운로드 페이지로 이동!" style="font-size:15px" /></form>';

}
if($errcode == "1"){
echo '<font color="red">비밀번호 오류입니다. 확인해주세요.</font>';
}elseif($errcode == "2"){
echo '<font color="red">존재하지 않는 파일입니다.</font>';
}
?>
    
  </form>