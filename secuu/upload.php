<?php
$error_code = $_GET["eid"];
require_once("../setting.php");
require_once("../define.php");
require_once("../advertise-setting.php");
$fp = fopen("../additional/maxsize.txt","r");
$fr = fread($fp, filesize("../additional/maxsize.txt"));
fclose($fp);
?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title><? echo SITENAME; ?></title>
   <script type="text/javascript">
      function fileSelected() {
        var file = document.getElementById('fileToUpload').files[0];
        if (file) {
          var fileSize = 0;
          if (file.size > 1024 * 1024)
            fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
          else
            fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';

          document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
          document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
          document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
        }
      }
</script>

        </head>
        <body>
<h1><? echo SITENAME; ?> - File Sharing Service (SECURE SHARE)</h1>
<br>
<?
showAD();
?>
<br>
<h3>Max File Size is <? echo $fr; ?>.</h3>
<form id="form1" enctype="multipart/form-data" method="post" action="upre.php">

    <div class="row">
      <label for="fileToUpload">Please select a file to upload.</label><br />
      <input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();"/>
    </div>
<hr>
Password(for delete):
<input type="password" name="pwedit" id="pwedit"/> <br>
Password Check(for delete):
<input type="password" name="pwedit2" id="pwedit2"/> <br>
<hr>
Password Check(for download):
<input type="password" name="pwdown" id="pwdown"/> <br>
Password Check(for download):
<input type="password" name="pwdown2" id="pwdown2"/> <br>
    <div id="fileName"></div>
    <div id="fileSize"></div>
    <div id="fileType"></div>
    <div class="row">
      <input type="submit" value="Upload!(Secure Share)" style="font-size:15px" />
    </div>
  </form>

<? if ($error_code == "nfs"){
echo '<font color="red">Please select a file to upload.</font>';
}elseif($error_code == "npw"){
	echo '<font color="red">Please enter password.</font>';
}elseif($error_code == "pns"){
echo '<font color="red">Two given password tokens are not same!</font>';
}?>
<br>
<footer>
<? echo SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER; ?>
</footer>
        </body>
</html>