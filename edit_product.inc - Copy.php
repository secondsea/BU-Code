<?php
// End brand names for drop down list
$brands=$sd->getBrandNames();
   if (isset($_GET['id'])) {
    $inventory->product_id = (int)$_GET['id'];
	} elseif (isset($_POST['id'])) {
	  $inventory->id = $_POST['id'];
	} else {
	  $inventory->id = NULL;
 }	
   
    if (!isset($_POST['submit'])) {
	//echo "true";
	   $initpass=TRUE; 
	   
	   $inventory->fetchProduct();
	   $lines=$sd->getLineNames($inventory->brand_id);
	}  else  {
	//echo "false";
	     $initpass=FALSE;
  $inventory->repostProductData();
  $inventory->updateProductData($p,$s);
	
	}
 

	include ('modules/inventory/product_form.php' );
 

	?>

 <a href="index.php?id=<?php echo $inventory->product_id?>&p=inventoy&sp=delete" class="one">Delete this Product</a> 