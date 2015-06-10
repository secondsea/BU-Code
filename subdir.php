
<?php

require_once('includes/data.php');
$sd= new SalonData;
    $sd->connect();

    //require_once('includes/directory.php');
   // $dd = new DirectoryData($sd);

    $dir_name = $_GET['dir_name'];
     $q = "INSERT INTO image_directory (directory_name) VALUES ('$dir_name')";
	//  echo $q;
	 $r = mysqli_query($sd->dbc, $q);
if (mysqli_affected_rows($sd->dbc)  == 1) {
?>	
	 <option selected value= "<?php echo $icon->directory_id;?>"><?php echo $icon->directory_name] ;?></option> 
	 <?php
	//run a prepared statement 
     $q = "SELECT directory_id, directory_name FROM image_directory ORDER BY directory_name ASC";
	 	 $r = mysqli_query($sd->dbc, $q);
	 if ($r) {
     	 while ($row = mysqli_fetch_array($r,  MYSQLI_ASSOC)) {
     	 	
             echo '<option value="'.$row["directory_id"] .'">'.$row["directory_name"]. '</option>'   ;        }

 				} else {

					echo '<p> sql query trashed </p><p> Here is why: ' . mysqli_error() . '</p>'; }
	
	
	
	

  } else {        echo '<p> sql query trashed </p><p> Here is why: ' . $dbc->error . '</p>';   }

	
	
	
	
	
	
	
	
?>
 