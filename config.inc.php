<?php # Script 2.1 - config.inc.php




if (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) { 
$local = TRUE;
} else {
$local = FALSE;
}
if ($local) {

 $debug = TRUE;
  define ('BASE_URI', 'C:/inetpub/wwwroot/');
	define ('BASE_URL', 'http://localhost/');
	define('DB', 'C:/inetpub/wwwroot/includes/salon_connect.php');
	} else {
	define ('BASE_URI','/ ');
	define ('BASE_URL', 'http://www.marycusack.com/');
	define ('DB',' ../../includes/connect.php');
	}
	
if ($p == 'thismodule') $debug = TRUE;
require_once('/includes/config.inc.php');
$debug = TRUE;
	if (!isset($debug)) {
	  $debug = FALSE;
	}
	
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
   global $debug, $contact_email;
	 
	 $message = "An error occured in script '$e_file', on line $e_line: \n<br />$e_message\n<br />";
	 $message  .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	 $message  .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<br />";
	 if ($debug) {
	 echo '<p class="error">' . $message . '</p>';
	 } else {
	 error_log ($message, 1, $contact_email);
	 if ( ($e_number != ENOTICE) && ($e_number < 2048)) {
	   echo '<p class="error"> A sytem error occurred, We apologize for the inconvenience.</p>'; 
		     }
		}
		} 
		
		set_error_handler ('my_error_handler');
		 ?>
				      

