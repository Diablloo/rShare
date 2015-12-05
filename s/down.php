<?php
require_once("../setting.php");
require_once("../define.php");

$allowed_host = $_SERVER['SERVER_ADDR'];
$host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

if(substr($host, 0 - strlen($allowed_host)) == $allowed_host) {
  
} else {
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

			$fp = fopen('../file/Secure/'.$file_id.'/filename.txt',"r"); //Read File Name. 
			$fr = fread($fp, filesize('../file/Secure/'.$file_id.'/filename.txt'));
			fclose($fp);
			

					$filepath = '../file/Secure/'.$file_id.'/secure/'.filename_hash($file_id); //Path of File


					$fp = fopen('../file/Secure/'.$file_id.'/count.txt',"r");
					$fr = fread($fp, filesize('../file/Secure/'.$file_id.'/down.txt')); //Increasing Download Counter
					fclose($fp);
					$newnum ++; 

					$file = fopen('../file/Secure/'.$file_id.'/count.txt', 'w');
					fwrite($file, $newnum);
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