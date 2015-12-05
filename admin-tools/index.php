<? $var = $_GET["i"]; ?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title>GnL(R) Share Admin-Tools(보안):Enforcing File Delete</title>
<script language="javascript">
checkN(){
var str;
  str=document.regform.pwman.value;
  if(str=="")
  {
   alert("비밀번호를 입력해주세요!");
   document.regform.pwman.focus();
   return false;
  }
}
</script>
        </head>
        <body>
<h1>GnL(R) Share Admin-Tools(보안):Enforcing File Delete</h1>
<h2>GnL(R) Share가 무료파일 호스팅의 새로운 기준을 제시합니다.</h2><h3>GnL(R) Share의 관리자 기능입니다. 이 기능은 절대로 관리자만이 사용해야 하며, 관리자 또한 주관적인 판단으로 파일을 삭제하지 마시고 파일 공유 정책(http://www.gnlshare.wink.ws/info/filepolicy.php)에 명시된 내용에 위반되는 경우에만 해당할때 삭제하셔야 합니다.</h3>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Gnl Share -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3504124324158064"
     data-ad-slot="6936401237"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<br>
                <form id="regform" action="delete.php" method="POST">
파일번호:
<input type="text" name="fid"/> <br>

                   
                    <input type="submit" />
                </form>
<? if($var == "1"){
echo '<font color="red">모든 필드를 채워주세요!</font>';
}elseif($var == "2"){
echo '<font color="red">올바른 파일번호를 입력해주세요!</font>';
}elseif($var == "3"){
echo '<font color="red">올바른 비밀번호를 입력해주세요!</font>';
} elseif($var == "4"){
echo '<font color="red">비밀번호파일 찾을 수 없음</font>';
} ?>
<br><br>
<a href="http://www.gnlshare.wink.ws/admin-tools/GnLS-Secure">GnLS-Secure(R) 파일 삭제</a>
        </body>
</html>