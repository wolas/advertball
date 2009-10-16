<?php 
  require_once("../../includes/initialize.php");
  
  if(!$session->is_admin()){redirect_to("../session/login.php");}

  //1. the current page number($current_page)
  $page=!empty($_GET['page']) ? (int) $_GET['page'] : 1;
  //2. records per page($per_page)
  $per_page=10;
  //3. total record count($total_count)
  $total_count = Agency::count_all();
  
  $pagination = new Pagination($page,$per_page,$total_count);

  // find the records for this page
  $sql = "SELECT * FROM agencies WHERE amount_paid > 0 ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $agencies = Agency::find_by_sql($sql);
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
    			  <h2>Agenzie</h2>
    			  <div id="scroll-container">
    					<div id="content">
  				
  				      <?php echo output_message($message); ?>

                <div style="float:right; padding-right: 30px;">
                  <table>
                    <tr>
                      <td><a href="index.php">Total number of agencies</a></td>
                      <td><?php echo count(Agency::find_all()); ?>
                    </tr>
                    <tr>
                      <td>Agencies already paid</td>
                      <td><?php echo count(Agency::find_by_sql("SELECT COUNT(*) FROM agencies WHERE amount_paid > 0")); ?>
                    </tr>
                  </table>
                </div>

                <br/>
                <br/>
                <br/>
            
                <table width="100%" >
                  <tr>
                	  <th style="text-align: left;">Agency</th>
                	  <th style="text-align: left;">Amount Paid</th>
                	  <th>&nbsp;</th>
                  </tr>


                <?php foreach($agencies as $agency): ?>
                  <tr valign="top">
                    <td><?php echo $agency->company_name    . "<br />"; ?></td>
                    <td><?php echo $agency->amount_paid    . "<br />"; ?></td>
                  </tr>
                <?php endforeach; ?>
                </table>
                <br/>
                <div id="pagination" style="clear: both;">
                  <?php
                  	if($pagination->total_pages() > 1) {
                  		if($pagination->has_previous_page()) { 
                    		echo "<a href=\"list_paid.php?page=" . $pagination->previous_page() . "\">&laquo; Previous</a> ";
                      }
                  		for($i=1; $i <= $pagination->total_pages(); $i++) {
                  			if($i == $page) {
                  				echo " <span class=\"selected\">{$i}</span> ";
                  			} else {
                  				echo " <a href=\"list_paid.php?page={$i}\">{$i}</a> "; 
                  			}
                  		}
                  		if($pagination->has_next_page()) { 
                  			echo " <a href=\"list_paid.php?page=" . $pagination->next_page() . "\">Next &raquo;</a> ";
                      }
                  	}
                  ?>
      			    </div>
      		    </div>
    			  </div>
    			  <div id="footer"><a href="../session/logout.php">Logout</a></div>
    			</div>
    		</div>
    	</td>
    </tr>
  </table>
</body>
</html>
<?php ob_end_flush();?>