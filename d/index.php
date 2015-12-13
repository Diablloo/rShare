<?
require_once("../setting.php");
require_once("../define.php");
require_once("../advertise-setting.php");
$file_id = $_GET["fid"]; //here is file id
$_SESSION['userdownload-session'] = sha1(md5($fild_id)).'_download_'.get_ip(); //Make Session of this file(if session not exists or information not correct, user cannot download.)

$fp = fopen("../file/".$fid."/secure/filename.txt","r"); //get file name (if file has been deleted, it returns File Not Found)
$FileName = fread($fp, filesize("../file/".$fid."/secure/filename.txt"));
fclose($fp);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><? echo $FileName; ?> - <? echo SITENAME; ?></title>
</head>
<body>
<?
if ($fileName = "File Not Found")
{
	$fp = fopen("../file/".$file_id."/secure/delete-reason.txt","r"); //get the file about why file deleted(User Deleted or Admin Deleted: [REASON])
	$ReasonDel = fread($fp, filesize("../file/".$file_id."/secure/delete-reason.txt"));
	fclose($fp);
	echo "<h1>Sorry. This file has already been deleted.</h1>";
	echo "<h2>Why my file has deleted? =>".$ReasonDel."</h2>";
}
else
{
	echo "<h1>".$FileName."</h1><br>";
	echo "<h2>Here is some information of ".$FileName.".</h2>";
	
	//File Extension
	$fp = fopen("../file/".$file_id."/secure/extension.txt","r"); //because rShare hashes the filename to prevent webshell attack. So, we have to read extension file. Because we can't unhash the file name...
	$FileExt = fread($fp, filesize("../file/".$file_id."/secure/extension.txt"));
	fclose($fp);
	echo "<h3>File Extension: ".$FileExt.".</h3>";
	//File Extension Dictionary(Optional)
	Check_For_ExtensionDic($FileExt); //If you donot want to use this, just delete this line :)
	
	//File Download Counter
	$fp = fopen("../file/".$file_id."/secure/count.txt","r"); //because rShare hashes the filename to prevent webshell attack. So, we have to read extension file. Because we can't unhash the file name...
	$DownCount = fread($fp, filesize("../file/".$file_id."/secure/count.txt"));
	fclose($fp);
	echo "<h3>Download Count: ".$DownCount.".</h3>";
	
	//File Size
	echo "<h3>File Size: ".FileSizeConvert(filesize("../file/".$file_id."/secure/".filename_hash($FileName)))."</h3>"
	
	//File Hashing (MD5)
	echo "<h3>MD5 Hash: ".md5_file("../file/".$file_id."/secure/".filename_hash($FileName))."</h3>";
	
	//File Hashing (SHA1)
	echo "<h3>Sha1 Hash: ".sha1_file("../file/".$file_id."/secure/".filename_hash($FileName))."</h3>";
	
	
}



function Check_For_ExtensionDic($ext)
{
	$dic = file_get_contents(SITEADDR."/additional/extensions/".$ext.".txt"); //Dictionary about php extension is pre-saved on /dictionary/extensions/php.txt
	if ($dic == "Dictionary Not Found!")
	{ //Noting.
	}
	else
	{
		echo 'a href="'.SITEADDR."/additional/extensions/".$ext.".txt".'" target="_blank">Extension Information</a>';
	}
}

function FileSizeConvert($bytes) //I got this source from PHP.net. Thanks to linda.collins@mailnator.com
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
?>
<br>
<h4>You Download is Ready! You can download by clicking the button below</h4>
<input type="button" style="font-size:7pt;height:22;" onclick="location.href='<? echo SITEADDR."/d/down.php?fid=".$file_id ?>';" value="Download" />
<br>
<? showAD(); ?>
<footer>
<? echo SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER; ?> -- Normal Share Mode
</footer>
</body>
</html>
