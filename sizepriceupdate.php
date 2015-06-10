<?php

/*
		Author: Iwebux
		Description: configure db connection
		Copyright: iwebux.com
*/
echo "here";

require_once('includes/data.php');
$sd= new SalonData;
    $sd->connect();
    // $dbHost = "localhost";
	  //$dbUser= "maryc";
	  //$dbPass="nmrk0507";
	  //$dbName="salon";

     //$dbc = mysqli_connect ($dbHost, $dbUser,$dbPass,$dbName)  
	//	OR die ('<p>Could not connect to the database!</p></body></html>');

if(isset($_POST['rownum']))
{
echo 'rownum set';
$field = $_POST['field'];
$data =  $_POST['value'];
$rownum = $_POST['rownum'];  
echo $rownum;
	//update_data($_GET['field'],$_GET['value'],$_GET['rownum']);
//}

/*Retrieve records from db*/
//function get_data()
//{
	
//	$q = "select * from size_price";
//	/
//	$r = @mysqli_query($dbc, $q);
	
//}
/*Update records in db*/
//function update_data($field, $data, $rownum)
//{


$q="UPDATE size_price SET $field = '$data' WHERE id = $rownum"; 
echo $q;
		
		    $r = @mysqli_query($sd->dbc, $q);
		  	if (mysqli_affected_rows($sd->dbc)  == 1) {
 
	
	 echo ' worked';

  } else {        echo '<p> sql query trashed </p><p> Here is why: ' . $dbc->error . '</p>';   }
  // mysql_close();
	

	
	
}

?>