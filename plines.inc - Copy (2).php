<?php

echo 'brands';

 switch ($sp) {
	case 'edit':
            $page='edit_brand.inc.php';
            $page_title="Edit Brand";
           // echo $sp;
            break;
 case 'add':
     $page ='add_brand.inc.php';
     $page_title ='Add Brand';
   echo $sp;
     break;
case 'delete':
     $page='delete_brand.inc.php'; 
    
    echo $sp;
    break;
default:
		$page = 'list_brands.inc.php';
		$page_title = 'Brands';
	break;
} // End of main switch.
// Make sure the file exists:
if (!file_exists('./modules/brands/' . $page)) {
	$page = 'main.inc.php';
	$page_title = 'Site Home Page';
	 }
	  include ('modules/brands/' . $page);
	 ?>
 
