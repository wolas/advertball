<?php
  require_once("../../includes/initialize.php");
  if (!$session->is_logged_in()) { redirect_to("../login.php"); } 

  //1. the current page number($current_page)
  $page=!empty($_GET['page']) ? (int) $_GET['page'] : 1;
  //2. records per page($per_page)
  $per_page=10;
  //3. total record count($total_count)
  $total_count = Team::count_all();
  //all records -
  //$photos=Photograph::find_all();
  $pagination = new Pagination($page,$per_page,$total_count);

  // find the records for this page
  $sql = "SELECT * FROM teams ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $teams = Team::find_by_sql($sql);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>:: Teams ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
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
  				<h1><a href="../index.html"><span>ADVERTBALL</span></a></h1>
  				<ul id="menu">
  					<li><a href="../agencies/index.php" class="menu_blank">Agencies</a></li>
  					<li><a href="../teams/index.php" class="menu_blank">Teams</a></li>
  					<li><a href="../matches/index.php" class="menu_blank">Matches</a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  			  <h2><img src="../../images/squadra.gif" /></h2>
  				<div id="scroll-container">
  					<div id="content">
  			  
              <?php echo output_message($message); ?>

              <table width="100%" >
                <tr>
              	  <th>Name</th>
              	  <th>Agency</th>
              	  <th>Coach</th>
              	  <th>Coach Email</th>
              	  <th>Coach Tel</th>
              	  <th>Assistant</th>
              	  <th>Assistant Email</th>
              	  <th>Assistant Tel</th>
              	  <th>Players</th>
              	  <th>&nbsp;</th>
                </tr>

              <?php foreach($teams as $team){ ?>
                <tr valign="top">
                  <td><a href="show.php?id=<?php echo $team->id ?>"><?php echo $team->name ?></a></td>
                  <td><?php echo $team->agency()->company_name ?></td>
                  <td><?php echo $team->coach_name ?></td>
                  <td><?php echo $team->coach_email ?></td>
                  <td><?php echo $team->coach_telephone ?></td>
                  <td><?php echo $team->assistant_name ?></td>
                  <td><?php echo $team->assistant_email ?></td>
                  <td><?php echo $team->assistant_telephone ?></td>
                  <td style="text-align:center"><?php echo count($team->players()) ?></td>
              	  <td>
              	    <a href="edit.php?id=<?php echo $team->id;?>">edit</a> 
              	    | <a href="delete.php?id=<?php echo $team->id;?>" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_method'); m.setAttribute('value', 'delete'); f.appendChild(m); f.appendChild(s);f.submit(); };return false;">Destroy</a>
              	  </td>
                </tr>
              <?php } ?>
              </table>



              <!--PAGINATION-->
              <div id="pagination" style="clear: both;">
              <?php
              	if($pagination->total_pages() > 1) {
              		if($pagination->has_previous_page()) { 
                  		echo "<a href=\"index.php?page=";
                   		echo $pagination->previous_page();
                    		echo "\">&laquo; Previous</a> "; 
                  	}

              		for($i=1; $i <= $pagination->total_pages(); $i++) {
              			if($i == $page) {
              				echo " <span class=\"selected\">{$i}</span> ";
              			} else {
              				echo " <a href=\"index.php?page={$i}\">{$i}</a> "; 
              			}
              		}

              		if($pagination->has_next_page()) { 
              			echo " <a href=\"index.php?page=";
              			echo $pagination->next_page();
              			echo "\">Next &raquo;</a> "; 
                  	}

              	}

              ?>
              </div>
  			    </div>
			    </div>
			    <div id="footer"><a href="logout.php">Logout</a> &bull; <a href="../../pages/teams/index.php">Public Site</a></div>
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