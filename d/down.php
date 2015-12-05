<?php
require_once("../setting.php");
require_once("../define.php");


$allowed_host = $_SERVER['SERVER_ADDR']; //This source code is using for checking hotlinking to file download link.
$host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST); //If you do not want to prevent hotlinking, please delete these lines(line 3 ~ 18)

if(substr($host, 0 - strlen($allowed_host)) == $allowed_host)
{
  //OK
}
else
{
	echo '<head>
	<meta charset="UTF-8">
	<title>Hotlinking Not Allowed - '.SITENAME.'</title>
	</head>';
	echo "<body>
	<h1>".SITENAME."</h1>
	<h3>We Do Not Allow File Hotlinking. :(</h3>
	<footer>
	".SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER."
	</footer>
	</body>";
	exit();
}

$file_id = $_GET["fid"];

if ($_SESSION['userdownload-session'] != sha1(md5($file_id)).'_download_'.get_ip()){
	echo '<head>
	<meta charset="UTF-8">
	<title>Hotlinking Not Allowed - '.SITENAME.'</title>
	</head>';
	echo "<body>
	<h1>".SITENAME."</h1>
	<h3>We Do Not Allow File Hotlinking. :(</h3>
	<footer>
	".SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER."
	</footer>
	</body>";
	exit();
	}

if (is_file('../file/'.$file_id.'/secure/delete-reason.txt')){
echo '<head>
	<meta charset="UTF-8">
	<title>File Not Found - '.SITENAME.'</title>
	</head>';
	echo "<body>
	<h1>".SITENAME."</h1>
	<h3>Sorry but file number".$file_id." was deleted.</h3>
	<footer>
	".SITENAME."'s File Sharing Service. Powered by ".PRODUCTNAME." v".RSHAREVER."
	</footer>
	</body>";
	exit();
}

			$fp = fopen('../file/'.$file_id.'/secure/filename.txt',"r");
			$fr = fread($fp, filesize('../file/'.$file_id.'/secure/filename.txt'));
			fclose($fp);
			

					$filepath = "../file/".$file_id."/secure/".filename_hash($FileName);


					$fpa = fopen('../file/'.$file_id.'/secure/count.txt',"r");
					$fra = fread($fpa, filesize('../file/'.$file_id.'/secure/count.txt'));
					fclose($fpa);
					$counter = $counter + 1; 

					$file = fopen('../file/'.$file_id.'/secure/count.txt', 'w');
					fwrite($file, $counter);
					fclose($file);

					//Please Do Not Edit lines below! Require for Downloading Files!!!
					$size   = filesize($filepath);
					header('Content-Description: File Sharing Service by RT M Dev');
					header('Content-Type: '.mime_content_type($filepath));
					header('Content-Disposition: attachment; filename=' . $fr); 
					header('Content-Transfer-Encoding: binary');
					header('Connection: Keep-Alive');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . $size);
					readfile($filepath); //Dowload File