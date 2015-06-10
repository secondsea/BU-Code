	<div id="display_wrap">
      <form action="index.php" method="post">
	  <input type="hidden" name="id" value="<?php echo $pline->id?>">
	    <input type="hidden" name="p" value="<?php echo $p?>">
		    <input type="hidden" name="sp" value="<?php echo $sp?>">
  <input type="hidden" name="pg" value="<?php echo $pg?>">
   <input type="hidden" name="s" value="<?php echo $s?>">
     <div id="field_wrapper">
		<div id="display_label">Brand:</div>
     	<div id="display_field"><?php echo $pline->bname ?></div>
	 </div>
	 <div id="field_wrapper">
		<div id="display_label">Name:</div>
		<div id="display_field"><?php echo $pline->lname ?></div>
	 </div>
	 <div id="field_wrapper">
	 <div id="display_label">Description:</div>
	 <div id="display_field"><?php echo $pline->description ?></div>
	 </div>
	<input type="submit" class="one" name="submit" value="<?php echo $submitLabel?>" /></td>

	  </form>
 </div>
 
