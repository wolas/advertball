<?php 
	ob_start();
	require_once("../../includes/initialize.php");
  if(!$session->is_admin()){redirect_to("../session/login.php");}
  
  $match = new Match();
	
	if(isset($_POST['commit'])){
		$match->team1_id = $_POST['team1_id'];
		$match->team2_id = $_POST['team2_id'];
    $match->date = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
    $match->time = date("Y-m-d H:i:s", mktime($_POST['hour'], $_POST['minute'], 0, 0, 0, 0));    
		
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

      function check_teams() {
        var msg;
        var reg_1 = new RegExp("^[+][0-9]\\d{2}-\\d{3}-\\d{4}$");
        if ( document.forms[0].team1_id.value ==  document.forms[0].team2_id.value) {
    		  msg = "Both teams cannot be the same";
      	} else {
      	    msg = null;
      	}
      	return msg;
      }
    
      var rules=new Array();
      rules[0]='time|required';
      rules[1]='date|required';
      rules[2]='team1_id|custom|check_teams()';
      rules[3]='team2_id|custom|check_teams()';
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
                		  <td><span id="errorsDiv_team1_id"></span></td>
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
                		  <td><span id="errorsDiv_team2_id"></span></td>
                		</tr>
                		<tr>
                			<td>Date</td>
                			<td>
                			  <select name="year" >
                          <option value='2009'>2009</option>
                          <option value='2010'>2010</option>
                        </select>
                			  
                			  <select name='month'>
                          <option value='01'>January</option>
                          <option value='02'>February</option>
                          <option value='03'>March</option>
                          <option value='04'>April</option>
                          <option value='05'>May</option>
                          <option value='06'>June</option>
                          <option value='07'>July</option>
                          <option value='08'>August</option>
                          <option value='09'>September</option>
                          <option value='10'>October</option>
                          <option value='11'>November</option>
                          <option value='12'>December</option>
                        </select>

                        <select name="day" >
                          <option value='01'>01</option>
                          <option value='02'>02</option>
                          <option value='03'>03</option>
                          <option value='04'>04</option>
                          <option value='05'>05</option>
                          <option value='06'>06</option>
                          <option value='07'>07</option>
                          <option value='08'>08</option>
                          <option value='09'>09</option>
                          <option value='10'>10</option>
                          <option value='11'>11</option>
                          <option value='12'>12</option>
                          <option value='13'>13</option>
                          <option value='14'>14</option>
                          <option value='15'>15</option>
                          <option value='16'>16</option>
                          <option value='17'>17</option>
                          <option value='18'>18</option>
                          <option value='19'>19</option>
                          <option value='20'>20</option>
                          <option value='21'>21</option>
                          <option value='22'>22</option>
                          <option value='23'>23</option>
                          <option value='24'>24</option>
                          <option value='25'>25</option>
                          <option value='26'>26</option>
                          <option value='27'>27</option>
                          <option value='28'>28</option>
                          <option value='29'>29</option>
                          <option value='30'>30</option>
                          <option value='31'>31</option>
                        </select>
                			</td>
                		  <td><span id="errorsDiv_date"></span></td>
                		</tr>
                		<tr>
                			<td>Time</td>
                			<td>
                			  <select name="hour" >
                          <option value='01'>01</option>
                          <option value='02'>02</option>
                          <option value='03'>03</option>
                          <option value='04'>04</option>
                          <option value='05'>05</option>
                          <option value='06'>06</option>
                          <option value='07'>07</option>
                          <option value='08'>08</option>
                          <option value='09'>09</option>
                          <option value='10'>10</option>
                          <option value='11'>11</option>
                          <option value='12'>12</option>
                          <option value='13'>13</option>
                          <option value='14'>14</option>
                          <option value='15'>15</option>
                          <option value='16'>16</option>
                          <option value='17'>17</option>
                          <option value='18'>18</option>
                          <option value='19'>19</option>
                          <option value='20'>20</option>
                          <option selected="selected" value='21'>21</option>
                          <option value='22'>22</option>
                          <option value='23'>23</option>
                          <option value='24'>24</option>
                        </select>
                        
                        <select name="minute" >
                          <option selected="selected" value='00'>00</option>
                          <option value='15'>15</option>
                          <option value='30'>30</option>
                          <option value='45'>45</option>
                        </select>
                			</td>
                		  <td><span id="errorsDiv_time"></span></td>
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
    			  <div id="footer"><a href="../session/logout.php">Logout</a> &bull; <a href="../../pages/matches/index.php">Public Site</a></div>
    			</div>
    		</div>
    	</td>
    </tr>
  </table>
</body>
</html>
<?php ob_end_flush();?>