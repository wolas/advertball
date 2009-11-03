<?php
  ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_admin()){redirect_to("../session/login.php");}
	
	$matches = Match::find_by_sql("SELECT * FROM matches ORDER BY date ASC");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Advertball - Matches</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
    <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../../images/icon.ico"> 
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../css/admin.css" media="screen"/>
  </head>
  <body>
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle">
    		  <div id="page">
      			<div id="ctnsx">
      				<h1><a href="../../index.html"><span>ADVERTBALL</span></a></h1>
      				<ul id="menu">
      					<li><a href="../agencies/index.php" class="menu_blank">Agencies</a></li>
      					<li><a href="../teams/index.php" class="menu_blank">Teams</a></li>
      					<li><a href="../matches/index.php" class="menu_blank">Matches</a></li>
      				</ul>
      			</div>
      			<div id="ctndx">
      			  <h2>Matches</h2>
              <div id="scroll-container">
      					<div id="content">
  				        
  				        <table width="100%">
  				          <tr>
  				            <th>Date</th>
  				            <th>Team 1</th>
  				            <th>Team 2</th>
  				            <th>&nbsp;</th>
  				          </tr>
  				          <?php foreach($matches as $match){ ?>
  				          <tr>
  				            <td>
  				              <?php echo strftime("%D", strtotime($match->date)) ?>
  				              -
  				              <?php echo strftime("%H:%M", strtotime($match->time)) ?>
  				            </td>
  				            <td>
  				              <a href="../teams/show.php?id=<?php echo $match->team1()->id ?>"><?php echo $match->team1()->name ?></a>
  				              <br/>
  				              Goals: <?php echo $match->team1_goals ?>
  				              <br/>
  				              Cards: <?php echo $match->team1_reds ?>(r), <?php echo $match->team1_yellows ?> (y)
  				              
  				            </td>
  				            <td>
  				              <a href="../teams/show.php?id=<?php echo $match->team2()->id ?>"><?php echo $match->team2()->name ?></a>
  				              <br/>
  				              Goals: <?php echo $match->team2_goals ?>
  				              <br/>
  				              Cards: <?php echo $match->team2_reds ?>(r), <?php echo $match->team2_yellows ?> (y)
  				            </td>
  				            <td width="220px">
  				              <a href="show.php?id=<?php echo $match->id ?>">Show</a>
  				              |
  				              <a href="edit.php?id=<?php echo $match->id ?>">Edit</a>
  				              |
  				              <a href="review.php?id=<?php echo $match->id ?>">Review</a>
  				              |
  				              <a href="delete.php?id=<?php echo $match->id ?>">Delete</a>
  				            </td>
  				          </tr>
  				          <?php } ?>
  				        </table>
  				        <p><a href="new.php">New</a></p>
                </div>
              </div>
  					  <div id="footer"><a href="../session/logout.php">Logout</a> &bull; <a href="../../pages/matches/index.php">Public Site</a></div>
			      </div>
			    </div>			    
    	  </td>
      </tr>
    </table>
  </body>
</html>
<?php ob_end_flush();?>