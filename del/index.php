<? 
$err_id = $_GET["i"]; 
require_once("../define.php");
require_once("../advertise-setting.php");
require_once("../setting.php");
?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title>File Delete (Normal Mode)<? echo SITENAME; ?></title>
        </head>
        <body>
<h1><? echo SITEADDR; ?></h1>
<? showAD(); ?>
<br>
                <form id="regform" action="delete.php" method="POST">
File Number:
<input type="text" name="fid"/> <br>
Password:
<input type="password" name="pwyo"/> <br>
                   
                    <input type="submit" />
                </form>
<? if($err_id == "1"){
echo '<font color="red">Please fill the all given forms!</font>';
}elseif($err_id == "2"){
echo '<font color="red">Please enter vaild file number!</font>';
}elseif($err_id == "3"){
echo '<font color="red">Please enter correct password!</font>';
} elseif($err_id == "4"){
echo '<font color="red">I think file has deleted...</font>';
} ?>

        </body>
</html>