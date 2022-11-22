<?php
@include_once('db.php');
$title = $select = $description =  '';

if (!$db) {
    die("Connection failed: " . mysql_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["title"]);
  $select = $_POST["select"];
  $description = test_input($_POST["description"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<html lang="en">
<head>
<title>Support - YouTube to mp3</title>
<meta name="robots" content="index,nofollow">
<meta name="keywords" content="youtube,mp3,converter,downloader,youtube2mp3,youtube2mp3.ml">
<meta name="image" content="http://youtube2mp3.ml/img/thumbnail.png">
<meta name="description" content="Convert and download YouTube videos to mp3 or mp4 files for free. There is no registration or software needed.">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta charset="UTF-8">
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome-animation.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700italic">
</head>
<body style="height:0px;">
<div id='slider' style="position:fixed;padding: 10px;overflow:scroll;box-sizing: content-box;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.68);background-color:rgb(255, 203, 254);"></div>
<button id='menubuttonopen' class="btn"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button>
<div id="menu">
<li id="cell"><button id='menubutton' onclick="window.location.href='/'" class="btn"><i class="fa fa-home fa-2x" aria-hidden="true"></i></button><span>Home</span></li>
<li id="cell"><button id='trigger' class="btn"><i class="fa fa-history fa-2x" aria-hidden="true"></i></button><span>History</span></li>
<li id="cell"><button id='menubutton' onclick="window.location.href='/support.php'" class="btn"><i class="fa fa-support fa-2x" aria-hidden="true"></i></button><span>Support</span></li>
<li id="cell"><button id='menubutton' onclick="window.location.href='https://fb.me/youtube2mp3.ml'" class="btn"><i class="fa fa-facebook fa-2x " aria-hidden="true"></i></button><span>Facebook Page</span></li>
</div>
<div id='section'>
<img class='img-responsive center-block' id='logo' src='img/logo.png'/>
<div id='alerts'>
</div>
</div>
<div id='converter_background'>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
<div class="panel panel-info text-left">
<div class="panel-heading" style="background-color: #8221ca;">
<span id='title_text'>Please fill in the form below.</span>
</div>
<div class="panel-body">
<input type="text" name="title" class="form-control" placeholder="Title..." maxlength="100">
<br>
<select name="select" class="form-control">
    <option value="0">Department...</option>
    <option value="1">Server connection</option>
    <option value="2">Song converting</option>
    <option value="3">Advertising</option>
    <option value="4">Other</option>
</select>
<br>
<textarea name="description"  class="form-control" rows="10" placeholder="Description..."></textarea><br>
<input type="submit" class="btn" style="background-color: #8221ca;color: #ffffff;">
</div>
</div></form>
</div>
<div id='ads'></div>
<div class="navbar navbar-default navbar-fixed-bottom hidden-xs">
    <div class="container">
	
   <p class="navbar-text pull-left" style="font-size: 10px;">© 2017 - Site Built By 
           <b><a alt="About the author" id="AuthorBtn">FreshBoyBG</a></b>
      </p>

    </div>
  </div>
	<div id="particles-js" style=" position:absolute;left:0;top:0;z-index:-1;"></div>
	<script src="js/particles.min.js"></script>
 <script type="text/javascript" src="js/socket.io-1.4.5.js"></script>
 <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
 <script type="text/javascript" src="js/slideReveal.js"></script>
 <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
<?php 
if ($_POST) {
if ($title != '' && $description != '' && $select != '0') {
$sql = "INSERT INTO `support` (`title`, `select`, `description`) VALUES ('$title', '$select', '$description')";
mysql_query($sql);
mysql_query('UPDATE `info` SET `value`=`value`+1  WHERE `name`=\'support\'');
echo '<script type="text/javascript"> addalert(1, "Your request has been successfully submitted"); </script>'; 
} elseif ($title == '') {
	echo '<script type="text/javascript"> addalert(3, "Title is required"); </script>';
	return;
} elseif ($description == '') {
	echo '<script type="text/javascript"> addalert(3, "Description is required"); </script>';
	return;
} else {
	echo '<script type="text/javascript"> addalert(3, "Department is required"); </script>';
	return;
}
}
?>