<?
define("RSHAREVER", "1.0.0-OpenSource"); //version
define("PRODUCTNAME", "rShare OpenSource Channel"); //product name

//Use this function to hash the file name.
function filename_hash($name){
	//if you do not want to use file name hasing, use this code. (rShare uses htaccess to 
	//do not allow users to access to uploaded file path, 
	//but to prevent unexpected situation, we recommend to hash the file name
	//to prevent webshell attack.)
	
	
	//return $name;
	return hash("sha256", $name);
}

	 function get_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}