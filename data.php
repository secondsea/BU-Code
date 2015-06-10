<?php
class SalonData{
  
    private $dbHost = NULL;
    private $dbUser = NULL;
    private $dbPass = NULL;
    public $dbName = NULL;
	public $link = NULL;
	public $queries = NULL;
	public $errors = NULL;
	public $dir_id = NULL;
	var $dbc=NULL;
   // public $image_id =NULL;
   // public $iname=NULL;
    public $iclass = NULL;
   // public $iclass_id = NULL;
   // public $itext = NULL;
   // public $image = NULL;
   
   public function __construct() {
 		$this->link = "";
		$this->queries = array ();
		$this->errors = array ();
    	$this->sqls = array ();
	 }
   
   
 function connect () {
 
      $this->dbHost = "localhost";
	  $this->dbUser= "maryc";
	  $this->dbPass="nmrk0507";
	  $this->dbName="salon";

     $this->dbc = mysqli_connect ($this->dbHost, $this->dbUser,$this->dbPass,$this->dbName)  
		OR die ('<p>Could not connect to the database!</p></body></html>');
}


function getPaging ($ct,$cf,$display) {
   $dbc=$this->dbc;
   $q = "SELECT COUNT($cf) FROM  $ct";
   $r= @mysqli_query ($dbc, $q);
   $row = @mysqli_fetch_array ($r, MYSQLI_NUM);
   $records = $row[0]; 
   if ($records > $display) {  $pages = ceil ($records/$display);   }else {  $pages = 1;  }
   return $pages;
}

function pageLinks ($page,$pages,$start,$display){
 if ($pages  > 1) {
		$current_page = ($start/$display) +1;
		$lowpage=$current_page - 5;
		$highpage=$current_page +5;
		$current_page != ($start/$display) +1;
echo '<div  id="page_links" >';
		if ($current_page != 	1 ) {
	   echo '
		<a href="index.php?p='.$page.'&pg=$pages' . $pages . '&s=' .($start - $display) .'">Previous</a>';
		}
	
		for ($i = 1; $i <= $pages; $i++) 
		 {
		 	if ($i >$lowpage && $i < $highpage){
	        if ($i != $current_page  && $i >= $lowpage && $i < $highpage) {
		          echo '<a href="index.php?p='. $page . '&pg=' . $pages . '&s=' . (($display * ($i - 1))) . '"> ' . $i . '</a> ';
		      }else{
					 echo ' ' . $i . ' ' ;  
		        	}
			    }
			 }
			 if ($current_page != $pages) { 
			    echo '<a href="index.php?p='. $page .'&pg=' . $pages . '&s=' . ($start + $display) . '">Next</a> '; 
                }
  			
			
			echo '</div>';
	   }  // end loop
	   

 

 } // end function page links


function getDirectories () {
$directories['0']="Select a directory";

     $q = "SELECT directory_id, directory_name FROM image_directory ORDER BY directory_name ASC";
     $r = mysqli_query($this->dbc, $q);
	 if ($r) {
     	 while ($row = mysqli_fetch_array($r,  MYSQLI_NUM)) { $directories[$row[0]] =$row[1];}

} else {

echo '<p> sql query trashed </p><p> Here is why: ' . $this->dbc->error() . '</p>'; }

return $directories;


}  // wnd getIconClasses


function getBrandNames () {

    $brands['0']="Select a Brand";
     $q = "SELECT brand_id, brand_name FROM brand ORDER BY brand_name ASC";
     $r = mysqli_query($this->dbc, $q);
	 if ($r) {
     	 while ($row = mysqli_fetch_array($r,  MYSQLI_NUM)) { $brands[$row[0]] =$row[1];}

} else {

echo '<p> sql query trashed </p><p> Here is why: ' . mysqli_error() . '</p>'; }

return $brands;


}  // wnd getBrandNames

function getLineNames ($brand) {

    //$lines['0']="Select a Product Line";
    
      
     $q = "SELECT line_id, line_name FROM product_line  where brand_id= $brand ORDER BY line_name ASC";
     $r = mysqli_query($this->dbc, $q);
	 if ($r) {
     	 while ($row = mysqli_fetch_array($r,  MYSQLI_NUM)) {
     	 	$lines[$row[0]] =$row[1];
     //	 	echo  '<option value="'.$row[0].'">'. $row[1].'</option>'  ;      
		 } 

} else {

echo '<p> sql query trashed </p><p> Here is why: ' . mysqli_error() . '</p>'; }

return $lines;


}  // wnd getLineNames


function getAllLineNames () {

    $brands['0']="Select a Brand";
     $q = "SELECT brand_id, brand_name FROM brand ORDER BY brand_name ASC";
     $r = mysqli_query($this->dbc, $q);
	 if ($r) {
     	 while ($row = mysqli_fetch_array($r,  MYSQLI_NUM)) { $brands[$row[0]] =$row[1];}

} else {

echo '<p> sql query trashed </p><p> Here is why: ' . mysqli_error() . '</p>'; }

return $brands;


}  // wnd getBrandNames






 } // end class

?>