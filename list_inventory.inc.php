<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php

$display=50;
$count_field="id";
$count_table="product";
$page="inventory";
  if (isset($_GET['s']) && is_numeric ($_GET['s'])) {  $start = $_GET['s'];  }else {   $start = 0;   }
  if (isset($_GET['pg']) && is_numeric ($_GET['pg'])) {
   $pages = $_GET['pg'];
} else {
$pages=$sd->getPaging($count_table,$count_field,$display);
}
?>
<div id="inventory_wrap">
	<ul id="inventory_list">
	
<?php 
$inventory->listInventory($start, $display, $pages);
?>
</ul>
</div>

<?php 
	$sd->pageLinks($page,$pages,$start,$display);


?>
</div>