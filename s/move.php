<?
$fid = $_POST['fid'];
$filestatus = $_POST['filestatus'];
$password = $_POST['pwedit'];


if(!is_dir("../file/GnLS-Secure/".$fid."/gnl_localservicesStorage")){
header("Location: index.php?fid=".$fid."&code=2");
}

$fp = fopen("../file/GnLS-Secure/".$fid."/gnl_localservicesStorage/downpw.txt","r");
$fr = fread($fp, filesize("../file/GnLS-Secure/".$fid."/gnl_localservicesStorage/downpw.txt"));
fclose($fp);

if(sha1(sha1($password)) == $fr){
$data2 = array('fid' => $fid, 'iscertified' => 'true-GnLSSecure-:'.$fid.':'.sha1($fid));
redirect_post("http://www.gnlshare.wink.ws/s/wait.php", $data2);
}else{
header("Location: index.php?fid=".$fid."&code=1");
echo 'Password Error';
}

/**
 * Redirect with POST data.
 *
 * @param string $url URL.
 * @param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
 * @param array $headers Optional. Extra headers to send.
 */
 function redirect_post($url, array $data, array $headers = null) {
    $params = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    if (!is_null($headers)) {
        $params['http']['header'] = '';
        foreach ($headers as $k => $v) {
            $params['http']['header'] .= "$k: $v\n";
        }
    }
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if ($fp) {
        echo @stream_get_contents($fp);
        die();
    } else {
        // Error
        throw new Exception("Error loading '$url', $php_errormsg");
    }
}