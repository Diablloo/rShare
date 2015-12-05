<?
define("AD-ENABLE", "false"); //You can enable Google Adsense by changing false to true.
//Please add your advertise code to /additional/advertise-code/advertise.txt

/*
code example:

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- (ADVERTISE NAME) -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3504124324158064"
     data-ad-slot="6936401237"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
*/
function showAD(){
	if (ADENABLE == "true"){
	$fp = fopen("../additional/advertise-code/advertise.txt","r");
	$AdCode = fread($fp, filesize("../additional/advertise-code/advertise.txt"));
	fclose($fp);
	echo $AdCode;
}
}
