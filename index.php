<?php 

require_once ('/includes/config.inc.php');
require_once('includes/data.php');
$sd= new SalonData;
$sd->connect();
if (isset($_GET['p'])) {   $p = $_GET['p']; 	} elseif (isset($_POST['p'])) { 	  $p = $_POST['p']; 	} else { 	  $p = NULL;  }	
if (isset($_GET['sp'])) {    $sp = $_GET['sp'];  	}  elseif (isset($_POST['sp'])) {  	$sp = $_POST['sp'];  } else { 	$sp = NULL;  }	
if (isset($_GET['pg'])) {    $pg = $_GET['pg'];   } elseif (isset($_POST['pg'])) { 	  $pg = $_POST['pg']; 	} else {  $pg = NULL;  }		     
if (isset($_GET['s'])) {    $s = $_GET['s'];   } elseif (isset($_POST['s'])) { 	  $s = $_POST['s']; 	} else {  $s = NULL;  }	

//echo $sp;
// determine page to insert into main template
 switch ($p) {
 	case 'about':
		$page = 'about.inc.php';
		$page_title = 'About This Site';
		break;
	case 'brands':
		require_once('includes/brand.php');  
		$brand= new BrandData($sd);
		$page = 'brands.inc.php';
		$page_title = 'Brand Maintenance';
      break;
	case 'pline':
	require_once('includes/pline.php');
	$pline = new PlineData($sd);
  $page='pline.inc.php'; 
  $page_title='Product Line Maintenance.';
	break;
	case 'inventory':
	require_once('includes/inventory.php');
	$inventory= new InventoryData($sd);
  $page='inventory.inc.php';
  $page_title='Inventory';
   break;
	case 'icons':
		require_once('includes/icon.php');
		$icon= new IconData($sd);
		$page='icons.inc.php';
		$page_title='Image Management';
     break;
	 
		case 'sizeprice':
	//	require_once('includes/icon.php');
//		$icon= new IconData($sd);
//		$page='icons.inc.php';
//		$page_title='Image Management';
     break;
	
case 'search':
//echo "blah";
  $page='search.inc.php';
	$page_title = 'Search Results';
	break;
default:
//echo "default";
//$page='blah';
		$page = 'main.inc.php';
		$page_title = 'Site Home Page';
	break;
	 
} // End of main switch.
// Make sure the file exists:
if (!file_exists('./modules/' . $page)) {
	$page = 'main.inc.php';
	$page_title = 'Site Home Page';
	 }
	 
	 include_once ('/includes/heading.html');
	 include ('modules/' . $page);
	 include_once ('/includes/footer.html');
	 
	 
?>

