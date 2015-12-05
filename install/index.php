<head>
<meta charset="UTF-8">
<title>rShare Verrryyy-Simple Web Setting Generator</title>
</head>
<body>

<h1>Welcome to rShare Verrryyy-Simple Web Setting Generator! Please input the information below and click Install!.</h1>
<h3>#####ALL FILEDS MUST NOT BE "NULL"!#####</h3>

<h4>***RT M Dev do not have any responsible for wrong inputed information!***</h4>
<h4>We did not added any code such as checking if field is null or invaild information!</h4>
    <form method="post" action="install.php">
Website Name: 
<input type="text" name="sitename" id="sitename"/> <br>
Website Address: 
<input type="text" name="siteaddress" id="siteaddress" value="<?php echo substr("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], 0, -8); ?>"/> <br>
Website Admin IP(max 1 ip): 
<input type="text" name="adminip" id="adminip" /><br>
Max Upload Size(Ex: 14M, 14G): 
<input type="text" name="maxupload" id="maxupload" /><br>
Max POST Size(Ex: 14M, 14G) *Must be higher than Max Upload Size!:
<input type="text" name="maxpost" id="maxpost" /><br>
    <div class="row">
      <input type="submit" value="Install!" style="font-size:15px" />
    </div>
    
  </form>
  </body>