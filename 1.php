<div class="historytitle" style="text-align: center;color: #000000;margin-bottom:10px"><b>Latest 5 converts</b> <i style="cursor:pointer" class="fa fa-refresh noselect faa-spin animated-hover fa-2x" id="refreshhistory"></i></div>
<?php 
@include_once('db.php');							
$num = 5;						
$result = mysql_query("SELECT * FROM History ORDER BY id DESC LIMIT $num",$db);
$row = mysql_fetch_array($result);
do
echo '

		<div class="visual" style="margin-bottom:15px;">
		<a href="http://server.youtube2mp3.ml:8000/'.$row['downloadurl'].'"><img src="https://img.youtube.com/vi/'.$row['url'].'/hqdefault.jpg" width="170" height="120"></a><br> 
		<font size="1"><span style="color: #678098;"><b>'.$row['name'].'</b></span> </font>
        </div>
		
';
	
while	($row = mysql_fetch_array($result));
?>

	<script>
	$("#refreshhistory").on("click", function () {
	$("#slider").load("1.php");
    });
	</script>
