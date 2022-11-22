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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>AdminPanel</title>
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
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                </div>       
 <?php
  $current=mysql_query("SELECT value FROM info WHERE `name`='current'",$bd); 
  $currentsum=mysql_result($current,0);
  $current2=mysql_query("SELECT goal FROM info WHERE `name`='current'",$bd); 
  $currentgoal=mysql_result($current2,0);
  $currentgoal=($currentsum/$currentgoal)*100;
  $support=mysql_query("SELECT value FROM info WHERE `name`='support'",$bd); 
  $supportsum=mysql_result($support,0); 
  $support2=mysql_query("SELECT goal FROM info WHERE `name`='support'",$bd); 
  $supportgoal=mysql_result($support2,0);
  $supportgoal=($supportsum/$supportgoal)*100;
  $visits=mysql_query("SELECT value FROM info WHERE `name`='visits'",$bd); 
  $visitssum=mysql_result($visits,0);
  $visits2=mysql_query("SELECT goal FROM info WHERE `name`='visits'",$bd); 
  $visitsgoal=mysql_result($visits2,0);
  $visitsgoal=($visitssum/$visitsgoal)*100;
  $storage=mysql_query("SELECT value FROM info WHERE `name`='storage'",$bd); 
  $storagesum=mysql_result($storage,0);
  $storage2=mysql_query("SELECT goal FROM info WHERE `name`='storage'",$bd); 
  $storagemax=mysql_result($storage2,0);
  $storagemax2=($storagesum/$storagemax)*100;    
?>                     
                <div class="page-content">
                        <div id="sum_box" class="row mbl">
                           <div class="col-sm-6 col-md-3">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-hdd-o"></i>
                                        </p>
                                        <h4 class="value">
                                            <span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0">
                                            </span>  <span><?php echo $storagesum; ?> / <?php echo $storagemax; ?> MB</span></h4>
                                        <p class="description">
                                            Storage</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $storagemax2; ?>%;" class="progress-bar progress-bar-success"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel income db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-signal"></i>
                                        </p>
                                        <h4 class="value">
                                            <span></span><span><?php echo $visitssum; ?></span></h4>
                                        <p class="description">
                                            Visitors</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $visitsgoal; ?>%;" class="progress-bar progress-bar-info"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel task db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-group"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $currentsum; ?></span></h4>
                                        <p class="description">
                                            Total converts</p>
											  <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"
                                                style="width: <?php echo $currentgoal; ?>%;" class="progress-bar progress-bar-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel visit db mbm">
                                    <div class="panel-body">
                                        <p class="icon">
                                            <i class="icon fa fa-ticket"></i>
                                        </p>
                                        <h4 class="value">
                                            <span><?php echo $supportsum; ?></span></h4>
                                        <p class="description">
                                           Submitted Tickets</p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                style="width: <?php echo $supportgoal; ?>%;" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-lg-12">
                                <div class="portlet box">
                                    <div class="portlet-header">
                                        <div class="caption">
                                            Last 5 converts</div>
                                    </div>
                                                 
                                 
                           
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
					<th><center>id</center></th>
                                        <th><center>Name</center></th>
                                        <th><center>Url</center></th>
										<th><center>Date and Time</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php
$num = 5;
$count = mysql_query("SELECT COUNT(*) FROM History",$bd);
$temp = mysql_fetch_array($count);
$post = $temp[0];

$total =(($post -1)/$num) +1;
$total = intval($total);

$page =1;
	if($page > $total) $page = $total;

$start = $page * $num - $num;

if ($temp[0] > 0)
{
$result = mysql_query("SELECT * FROM History ORDER BY id DESC LIMIT $start, $num",$bd);
if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do

echo '
<tbody align="center">
																				<tr>
																						<td>'.$row['id'].'</td>
																							<td>'.$row['name'].'</td>
																								<td ><a href="https://www.youtube.com/watch?v='.$row['url'].'">Link</a></td>
																									<td>'.$row['datetime'].'</td>
																								
																								</tr>

																		</tbody>
																			


';
	
while	($row = mysql_fetch_array($result));
}
}
?>	                               
                           
                                    </tbody>
                                </table>
                            
                        </div>
                                </div>
                            </div>
                                                  
                                        
    
                            
                        </div>
                    </div>
                </div>
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