<?php
/* 
 * define core paths 
 * should be absolute to guarantees that they work as expected 
 * (\for Window, / for unix)
 */
define('DS',DIRECTORY_SEPARATOR);
define('SITE_ROOT',getenv("DOCUMENT_ROOT").DS.'advertball');
define('LIB_PATH',SITE_ROOT.DS.'/public/includes');

//echo getenv("DOCUMENT_ROOT") ."<br />";
//echo realpath(basename(getenv("SCRIPT_NAME")));
//must keep this order
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");
require_once(LIB_PATH.DS."pagination.php");
require_once(LIB_PATH.DS."agency.php");
require_once(LIB_PATH.DS."administrator.php");

?>
