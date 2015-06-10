<?php
// End brand names for drop down list
$brands=$sd->getBrandNames();
//$id =0;
  if (isset($_POST['submit'])) {
  

  $pline->repostLineData();
  $pline->addPlineData($p,$s);
 

} else {

	   $pline->initPlineData();


}
	include ('modules/pline/pline_form.php' );
?>