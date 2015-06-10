<?php


   if (isset($_GET['id'])) {
    $pline->id = (int)$_GET['id'];
	} elseif (isset($_POST['id'])) {
	  $pline->id = $_POST['id'];
	} else {
	  $pline->id = NULL;
 }	
//   echo 'the icon id is '  . $icon->id;
    if (!isset($_POST['submit'])) {
	
	   $initpass=TRUE; 
	   
	   $inventory->fetchProduct();
	   
	}  else  {
	
	     $initpass=FALSE;
                  
  //$brand->repostBrandData();
  $inventory->removeProductData($p,$s);
	
	}
 
  $submitLabel="Delete";
	include ('modules/pline/product_display.php' );
 

	?>
