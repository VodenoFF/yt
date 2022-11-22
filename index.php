<?php 
@include_once('db.php');
mysql_query('UPDATE `info` SET `value`=`value`+1  WHERE `name`=\'visits\'',$db);
?>
<html lang="en">
<head>
<title>YouTube to mp3</title>
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
	<?php
		$totalvisits = mysql_query("select value from info where name='visits'",$db);
		$totalvisits2=mysql_result($totalvisits,0);
	?>
<a id="vcounter"><?php echo $totalvisits2;?></a>
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
<div id='converter_background'>
 
<div id='converter'>
<div id='title'>
<span id='title_text'>Please insert a YouTube Video link :)</span>
</div>
<div id='input_background'>
<form id='form'>
<input id='video' type='text'/>
<button id='button' type='button' class="btn convertbutton">Convert</button>
</form>
</div>
<div class="row">
<div class="col-md-3" id='thumbnail'></div><div class="col-md-6"><span id="songtitle" style=""></span>
<button id='download' type='button' class="btn">Download</button></div>
</div>
<div id="progressbar" class="container">
    <div class="progress progress-striped active">
        <div class="progress-bar" id="progressbarp" style="width: 1%;"></div>
    </div>
</div>
</div>
<div id='formats'>
<a class='first' id='mp3'>mp3</a>
<a id='mp4'>mp4</a>
<a id="nextsong" style="display: none;">Convert another video</a>

</div>
</div>
</div>
  <div class="modal fade" id="Author" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">About the Author</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br>Some text in the modal.<br></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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