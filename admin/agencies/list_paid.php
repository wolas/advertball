<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
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
    <title>:: Agencies ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../../images/icon.ico"> 
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
  					<li><a href="../dashboard.php" class="menu_blank">Dashboard</a></li>
  					<li><a href="index.php" class="menu_blank">Agencies</a></li>
  					<li><a href="../teams/index.php" class="menu_blank">Teams</a></li>
  					<li><a href="../logout.php" class="menu_blank">Logout</a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  				<h2>Agencies</h2>
  				
  				 <?php echo output_message($message); ?>

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
            	  <td><a href="edit_item.php?id=<?php echo $agency->id;?>">edit</a> | <a href="delete_item.php?id=<?php echo $agency->id;?>">delete</a></td>
              </tr>
            <?php endforeach; ?>
            </table>
            <br/>
            <!--PAGINATION-->
            <div id="pagination" style="clear: both;">
              <?php
              	if($pagination->total_pages() > 1) {
              		if($pagination->has_previous_page()) { 
                  		echo "<a href=\"list_paid.php?page=";
                   		echo $pagination->previous_page();
                    		echo "\">&laquo; Previous</a> "; 
                  	}

              		for($i=1; $i <= $pagination->total_pages(); $i++) {
              			if($i == $page) {
              				echo " <span class=\"selected\">{$i}</span> ";
              			} else {
              				echo " <a href=\"list_paid.php?page={$i}\">{$i}</a> "; 
              			}
              		}

              		if($pagination->has_next_page()) { 
              			echo " <a href=\"list_paid.php?page=";
              			echo $pagination->next_page();
              			echo "\">Next &raquo;</a> "; 
                  	}

              	}

              ?>
  				
  			    </div>
			
  		    </div>
  	    </td>
      </tr>
    </table>
  </body>
</html>
