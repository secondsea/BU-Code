<?php
//include('config.php');
require_once('includes/data.php');
$sd= new SalonData;
$sd->connect();
//collect the passed id
$id = $_GET['brand_id'];
//echo '<option value="here">there</option>';

//run a prepared statement 
    $q = "SELECT line_id, line_name FROM product_line  where brand_id= $id ORDER BY line_name ASC";
	     $r = mysqli_query($sd->dbc, $q);
	 if ($r) {
     	 while ($row = mysqli_fetch_array($r,  MYSQLI_ASSOC)) {
     	 	
             echo '<option value="'.$row["line_id"] .'">'.$row["line_name"]. '</option>'   ;        }

} else {

echo '<p> sql query trashed </p><p> Here is why: ' . mysqli_error() . '</p>'; }
//$stmt = $conn->query('SELECT bookID,bookTitle FROM books WHERE catID = '.$conn->quote($id).' ORDER BY bookTitle');

//loop through all returned rows
//while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
 //   echo "<option value='$row->bookID'>$row->bookTitle</option>";
//}


