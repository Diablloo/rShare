<? $var = $_GET["i"]; ?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title>GnLS-Secure(R) 파일삭제 페이지</title>
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
<h1>GnLS-Secure(R) by GnL(R) Share 파일 삭제 페이지</h1>
<h2>GnL(R) Share가 무료파일 호스팅의 새로운 기준을 제시합니다.</h2><h3>GnL(R) Share의 보안 파일 공유 시스템인 GnLS-Secure(R)를 이용해주셔서 감사합니다. 다음에도 또 됩길 바랍니다 :)</h3>
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
<input type="text" name="fid"/> <br><hr>
비밀번호:
<input type="password" name="pwyo"/> <br>
                   <br>
                    <input type="submit" value="삭제"/>
                </form>
<? if($var == "1"){
echo '<font color="red">모든 필드를 채워주세요!</font>';
}elseif($var == "2"){
echo '<font color="red">올바른 파일번호를 입력해주세요!</font>';
}elseif($var == "3"){
echo '<font color="red">올바른 비밀번호를 입력해주세요!</font>';
} elseif($var == "4"){
echo '<font color="red">비밀번호파일를 찾을 수 없습니다. 이미 삭제된 것 같습니다.</font>';
} ?>

        </body>
</html>