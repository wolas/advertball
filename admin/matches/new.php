<?php 
	ob_start();
	require_once("../../includes/initialize.php");

  $match = new Match();
	
	if(isset($_POST['commit'])){
		$match->team1_id = $_POST['team1_id'];
		$match->team2_id = $_POST['team2_id'];
		$match->date = $_POST['date'];
		$match->time = $_POST['time'];
		$match->location = $_POST['location'];
		
		if($match->save()){
		  redirect_to("show.php?id=" . $match->id);
		}else{
		  $message = "Unable to insert data";	  
		}
		
	}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Crea partita</title>
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
	<script src="../../js/yav.js"></script>
  <script src="../../js/yav-config.js"></script>
    <script>
        var rules=new Array();
        rules[0]='location|required';
        rules[1]='date|required';
        rules[2]='time|required';
    </script>
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
    					<li><a href="../matches/index.php" class="menu_blank">Teams</a></li>
    				</ul>
    			</div>
    			<div id="ctndx">
    			  <h2><img src="../../images/edit_team.gif" alt="Modifica Squadra" /></h2>
    			  <div id="scroll-container">
    					<div id="content">
    					  <h3><?php echo $message ?></h3>
    					  
  				  	  <form class="center_table" name="_form" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                	<table class="edit_table center_table" style="font-weight: bold;">
                		<tr>
                			<td>Team 1</td>
                			<td>
                			  <select id="team1_id" name="team1_id">
                			    <?php foreach(Team::find_all() as $team){ ?>
                          <option value="<?php echo $team->id ?>"><?php echo $team->name ?></option>
                          <?php } ?>
                        </select>
                			</td>
                		  <td>&nbsp;</td>
                		</tr>
                		<tr>
                			<td>Team 2</td>
                			<td>
                			  <select id="team2_id" name="team2_id">
                			    <?php foreach(Team::find_all() as $team){ ?>
                          <option value="<?php echo $team->id ?>"><?php echo $team->name ?></option>
                          <?php } ?>
                        </select>
                			</td>
                		  <td>&nbsp;</td>
                		</tr>
                		<tr>
                			<td>Date</td>
                			<td><input id="date" name="date" size="30" maxlength="30" type="text" value="<?php echo $match->date;?>"/></td>
                		  <td><span id="errorsDiv_date"></span></td>
                		</tr>
                		<tr>
                			<td>Time</td>
                			<td><input id="time" name="time" size="30" maxlength="30" type="text" value="<?php echo $match->time;?>"/></td>
                		  <td><span id="errorsDiv_time"></span></td>
                		</tr>
                		<tr>
                			<td>Location</td>
                			<td><input id="location" name="location" size="30" maxlength="30" type="text" value="<?php echo $match->location;?>"/></td>
                		  <td><span id="errorsDiv_location"></span></td>
                		</tr>
                		<tr><td colspan="3" class="table_separator">&nbsp;</td></tr>
                		<tr>
                		  <td><a href="index.php"><img src="../../images/btn_back.gif" style="float:left"/></a></td>
                			<td><input id="commit" name="commit" class="save" type="submit" value="" style="float:right"/></td>
                      <td>&nbsp;</td>
                		</tr>
                	</table>
                </form>
    			    </div>
    			  </div>
    			  <div id="footer"><a href="logout.php">Logout</a></div>
    			</div>
    		</div>
    	</td>
    </tr>
  </table>
  <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("UA-7408828-12");
    pageTracker._trackPageview();
    } catch(err) {}
  </script>

</body>
</html>
<?php ob_end_flush();?>