<?php 
	ob_start();
	require_once("../../includes/initialize.php");

  $match = Match::find_by_id($_GET['id']);
	
	if(isset($_POST['commit'])){
    $match->team1_goals = $_POST['team1_goals'];
    $match->team1_reds = $_POST['team1_reds'];
    $match->team1_yellows = $_POST['team1_yellows'];
    $match->team2_goals = $_POST['team2_goals'];
    $match->team2_reds = $_POST['team2_reds'];
    $match->team2_yellows = $_POST['team2_yellows'];
		
		if($match->save()){
		  redirect_to("show.php?id=" . $match->id);
		}else{
		  $message = "Unable to insert data";	  
		}
		
	}
	
	function selected($format, $value)
	{
	  global $match;
    if(strftime($format, strtotime($match->date)) == $value){return "selected=\"selected\" ";}
	}
	
	function selected_time($format, $value)
	{
	  global $match;
    if(strftime($format, strtotime($match->time)) == $value){return "selected=\"selected\" ";}
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
        rules[0]='team2_goals:goasl|required';
        rules[1]='team2_reds:red cards|required';
        rules[2]='team2_yellows:yellow cards|required';
        rules[3]='team1_goals:goals|required';
        rules[4]='team1_reds:red cards|required';
        rules[5]='team1_yellows:yellow cards|required';
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
    					<li><a href="../matches/index.php" class="menu_blank">Matches</a></li>
    				</ul>
    			</div>
    			<div id="ctndx">
    			  <h2><img src="../../images/review_match.gif" alt="Review Match" /></h2>
    			  <div id="scroll-container">
    					<div id="content">
    					  <h3><?php echo $message ?></h3>
    					  
  				  	  <form class="center_table" name="_form" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                	
                	<div style="float:left; width: 50%">
                	  <table>
                	    <tr>
                	      <th colspan="3"><?php echo $match->team1()->name ?></th>
                	    </tr>
                	    <tr>
                  			<td>Goals</td>
                  			<td><input style="width:30px;" id="team1_goals" name="team1_goals" size="3" maxlength="3" type="text" value="<?php echo $match->team1_goals;?>"/></td>
                  		  <td><span id="errorsDiv_team1_goals"></span></td>
                  		</tr>
                  		<tr>
                  			<td>Red Cards</td>
                  			<td><input style="width:30px;" id="team1_reds" name="team1_reds" size="3" maxlength="3" type="text" value="<?php echo $match->team1_reds;?>"/></td>
                  		  <td><span id="errorsDiv_team1_reds"></span></td>
                  		</tr>
                  		<tr>
                  			<td>Yellow Cards</td>
                  			<td><input style="width:30px;" id="team1_yellows" name="team1_yellows" size="3" maxlength="3" type="text" value="<?php echo $match->team1_yellows;?>"/></td>
                  		  <td><span id="errorsDiv_team1_yellows"></span></td>
                  		</tr>
                	  </table>
                	</div>
                	
                	<div style="float:left; width: 50%">
                	  <table>
                	    <tr>
                	      <th colspan="3"><?php echo $match->team2()->name ?></th>
                	    </tr>
                	    <tr>
                  			<td>Goals</td>
                  			<td><input style="width:30px;" id="team2_goals" name="team2_goals" size="3" maxlength="3" type="text" value="<?php echo $match->team2_goals;?>"/></td>
                  		  <td><span id="errorsDiv_team2_goals"></span></td>
                  		</tr>
                  		<tr>
                  			<td>Red Cards</td>
                  			<td><input style="width:30px;" id="team2_reds" name="team2_reds" size="3" maxlength="3" type="text" value="<?php echo $match->team2_reds;?>"/></td>
                  		  <td><span id="errorsDiv_team2_reds"></span></td>
                  		</tr>
                  		<tr>
                  			<td>Yellow Cards</td>
                  			<td><input style="width:30px;" id="team2_yellows" name="team2_yellows" size="3" maxlength="3" type="text" value="<?php echo $match->team2_yellows;?>"/></td>
                  		  <td><span id="errorsDiv_team2_yellows"></span></td>
                  		</tr>
                	  </table>
                	</div>
                	
                	<div style="height:20px;clear:both"></div>
                	<table width="60%">
                		<tr>
                		  <td><a href="index.php"><img src="../../images/btn_back.gif" style="float:left"/></a></td>
                			<td><input id="commit" name="commit" class="save" type="submit" value="" style="float:right"/></td>
                		</tr>
                	</table>
                </form>
    			    </div>
    			  </div>
    			  <div id="footer"><a href="logout.php">Logout</a> &bull; <a href="../../pages/matches/index.php">Public Site</a></div>
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