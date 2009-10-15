<?php 
	ob_start();
	require_once("../../includes/initialize.php");

  $match = Match::find_by_id($_GET['id']);
	
	if(isset($_POST['commit'])){
		$match->team1_id = $_POST['team1_id'];
		$match->team2_id = $_POST['team2_id'];
		$match->location = $_POST['location'];
		$match->date = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
    $match->time = date("Y-m-d H:i:s", mktime($_POST['hour'], $_POST['minute'], 0, 0, 0, 0));    
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
        rules[0]='location|required';
        rules[1]='date|required';
        rules[2]='time|required';
        rules[3]='team1_goals|required';
        rules[4]='team1_reds|required';
        rules[5]='team1_yellows|required';
        rules[6]='team2_goals|required';
        rules[7]='team2_reds|required';
        rules[8]='team2_yellows|required';
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
                          <option <?php if($match->team1_id == $team->id){echo "selected=\"selected\"";}?> value="<?php echo $team->id ?>"><?php echo $team->name ?></option>
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
                          <option <?php if($match->team2_id == $team->id){echo "selected=\"selected\"";}?> value="<?php echo $team->id ?>"><?php echo $team->name ?></option>
                          <?php } ?>
                        </select>
                			</td>
                		  <td>&nbsp;</td>
                		</tr>
                		<tr>
                			<td>Date</td>
                			<td>
                			  
                			  <select name="year" >
                          <option <?php echo selected("%Y", "2009") ?>value='2009'>2009</option>
                          <option <?php echo selected("%Y", "2010") ?>value='2010'>2010</option>
                        </select>
                			  
                			  <select name='month'>
                          <option <?php echo selected("%m", "01") ?>value='01'>January</option>
                          <option <?php echo selected("%m", "02") ?>value='02'>February</option>
                          <option <?php echo selected("%m", "03") ?>value='03'>March</option>
                          <option <?php echo selected("%m", "04") ?>value='04'>April</option>
                          <option <?php echo selected("%m", "05") ?>value='05'>May</option>
                          <option <?php echo selected("%m", "06") ?>value='06'>June</option>
                          <option <?php echo selected("%m", "07") ?>value='07'>July</option>
                          <option <?php echo selected("%m", "08") ?>value='08'>August</option>
                          <option <?php echo selected("%m", "09") ?>value='09'>September</option>
                          <option <?php echo selected("%m", "10") ?>value='10'>October</option>
                          <option <?php echo selected("%m", "11") ?>value='11'>November</option>
                          <option <?php echo selected("%m", "12") ?>value='12'>December</option>
                        </select>

                        <select name="day" >
                          <? for ($i = 1; $i <= 31; $i++){
                            echo "<option " . selected("%d", $i ) . "value='$i'>$i</option>\n";
                          } ?>
                        </select>
                			</td>
                		  <td><span id="errorsDiv_date"></span></td>
                		</tr>
                		<tr>
                			<td>Time</td>
                			<td>
                			  <select name="hour" >
                          <? for ($i = 1; $i <= 24; $i++){
                            echo "<option " . selected_time("%H", $i ) . "value='$i'>$i</option>\n";
                          } ?>
                        </select>
                        <select name="minute" >
                          
                          <option <?php echo selected_time("%M", "00") ?>value='00'>00</option>
                          <option <?php echo selected_time("%M", "15") ?>value='15'>15</option>
                          <option <?php echo selected_time("%M", "30") ?>value='30'>30</option>
                          <option <?php echo selected_time("%M", "45") ?>value='45'>45</option>
                        </select>
                			</td>
                		  <td><span id="errorsDiv_time"></span></td>
                		</tr>
                		<tr>
                			<td>Location</td>
                			<td><input id="location" name="location" size="30" maxlength="30" type="text" value="<?php echo $match->location;?>"/></td>
                		  <td><span id="errorsDiv_location"></span></td>
                		</tr>
                		<tr>
                		  <td><a href="index.php"><img src="../../images/btn_back.gif" style="float:left"/></a></td>
                			<td><input id="commit" name="commit" class="save" type="submit" value="" style="float:right"/></td>
                		  <td>&nbsp;</td>
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