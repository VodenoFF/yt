<?php
session_start();
if ($_SESSION['auth_admin'] == 'yes_auth')
{
if (isset($_GET["logout"]))
{
	unset($_SESSION['auth_admin']);
	header ("location: login.php");
}
include("connector.php");
$action = isset($_GET["action"]);
if (!empty($action))
{
$id=(int)$_GET["id"];
switch ($action) {
case 'delete':
$delete = mysql_query("DELETE FROM History WHERE id='$id'",$bd);
break;
}
}
?>
<html lang="en">
<head>
    <title>Support - AdminPanel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">

</head>
<body>
    <div>
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo"  class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">AdminPanel</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a></div>
        </nav>
        </div>
        <div id="wrapper">
                <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>
                    <li><a href="index.php"><i class="fa fa-home fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Home</span></a></li>
                    <li><a href="history.php"><i class="fa fa-history fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">History</span></a>
                       

                      
                    </li>
                       <li><a href="support.php"><i class="fa fa-ticket fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Support</span></a>
                      
                    </li>


					 <li><a href="?logout"><i class="fa fa-key">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Logout</span></a>
                      
                    </li>
                </ul>
            </div>
        </nav>
            <div id="page-wrapper">
                <div class="page-content">
<?php
$all_support = mysql_query("SELECT * FROM support",$bd);
$result_support = mysql_num_rows($all_support);
?>
<span class="h2class">Total:<span class="badge bg-theme"><b><?php echo $result_support; ?></b></span>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
																		<thead>
																				<tr>
																								<th><center>ID</center></th>
																								<th><center>Title</center></th>
																								<th><center>Department</center></th>
																								<th><center>Description</center></th>	
																								<th><center>Tools</center></th>																						
																				</tr>
																		</thead>
<?php
$num = 5;
$page = $_GET['page'];
$page =mysql_real_escape_string($page); 
$count = mysql_query("SELECT COUNT(*) FROM support",$bd);

$temp = mysql_fetch_array($count);
$post = $temp[0];

$total =(($post -1)/$num) +1;
$total = intval($total);

$page = intval($page);

if(empty($page) or $page <0) $page =1;
	if($page > $total) $page = $total;

$start = $page * $num - $num;

if ($temp[0] > 0)
{
$result = mysql_query("SELECT * FROM support ORDER BY id DESC LIMIT $start, $num",$bd);
if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do{
$selected = 0;
if ($row["select"] == 1) {$selected = 'Server connection';} else if ($row["select"] == 2) {$selected = 'Song converting';} else if ($row["select"] == 3){$selected = 'Advertising';} else if ($row["select"] == 4) {$selected = 'Other';}
echo '
<div class="block-clients">
<tbody align="center">
																				<tr>			<td>'.$row['id'].'</td>
																								<td valign="middle">'.$row["title"].'</td>
																								<td>'.$selected.'</td>			
																								<td valign="middle">'.$row["description"].'</td>
																							    <td><span class="tooltip-area">
																									 <a role="button" class="btn btn-danger" href="history.php?id='.$row['id'].'&action=delete" class="delete">Delete</a>
																									</span>
</td></tr>

</div>

';

}while	($row = mysql_fetch_array($result));
}
} 

if ($page != 1) $prevpage =' <ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='.($page -1).'">&laquo;</a></li></ul>';
if ($page != $total) $nextpage ='<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='.($page + 1).'">&raquo;</a></li></ul>';

if($page - 3 > 0) $page3left = '<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='. ($page -3) .'">'.($page - 3).'</a></li></ul>';
if($page - 2 > 0) $page2left = '<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='. ($page -2) .'">'.($page - 2).'</a></li></ul>';
if($page - 1 > 0) $page1left = '<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='. ($page -1) .'">'.($page - 1).'</a></li></ul>';

if($page + 3 <= $total) $page3right = '<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='. ($page +3) .'">'.($page + 3).'</a></li></ul>';
if($page + 2 <= $total) $page2right = '<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='. ($page +2) .'">'.($page + 2).'</a></li></ul>';
if($page + 1 <= $total) $page1right = '<ul data-hover="" class="pagination mtm mbm"><li><a href="history.php?page='. ($page +1) .'">'.($page + 1).'</a></li></ul>';


if ($total > 1)
{
echo $prevpage.$page3left.$page2left.$page1left."<ul data-hover='' class='pagination mtm mbm'><li class='disabled'><a href='history.php?page=".$page."'>".$page."</a></li></ul>".$page1right.$page2right.$page3right.$nextpage;
}
?></div>
              
            </div>
        </div>
    </div>
    <script src="script/jquery-1.10.2.min.js"></script>
    <script src="script/jquery-migrate-1.2.1.min.js"></script>
    <script src="script/bootstrap.min.js"></script>
    <script src="script/jquery.menu.js"></script>
</body>
</html>
<?php
}else
{
	header ("location: login.php");
}
?>