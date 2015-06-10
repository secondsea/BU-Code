<?php
class BrandData  {
var $data;
    public $brand_id =NULL;
    public $bname=NULL;
    public $logo=NULL;
    
   public function __construct($obj) {
       // this transfers the main data object to this object
       $this->data=$obj; 
 
 		$this->link = "";
		$this->queries = array ();
		$this->errors = array ();
    	$this->sqls = array ();
	 }
         
         
         
function listBrands() {
    $dbc = $this->data->dbc;
    $q = "SELECT brand_id, brand_name, logo_id FROM brand";

    //JOIN icon_class USING(iclass_id)  ORDER BY image_id ASC LIMIT $start, $display" ;
$r = mysqli_query($dbc, $q);
echo '<ul>';
while (list($brand_id, $name, $logo)=mysqli_fetch_array($r, MYSQLI_NUM)){
  echo   ' <li> <a href="index.php?id=' . $brand_id . '&p=brands&sp=edit">'. $name . '</a></li>';
}
    
    
    //return brandArray
}
 
function fetchBrand ( ){
	$dbc = $this->data->dbc;
	if ($this->id > 0) {

      $q ="SELECT brand_id, brand_name, logo_id FROM brand WHERE brand_id=$this->id"; 
          //JOIN icon_class USING(iclass_id) WHERE image_id=$this->id";
	      $r = mysqli_query($dbc, $q);
	      if (mysqli_num_rows($r) == 1) {
              list($this->brand_id, $this->bname, $this->logo) = mysqli_fetch_array($r, MYSQLI_NUM);
		} // End of mysqli_num_rows() IF.
		   else {
     echo '<p> sql query trashed </p><p> Here is why: ' . $dbc->error . '</p>'; }
	} // End of ($gw_id > 0) IF.

}

function repostBrandData () {


      $this->brand_id = $_POST['id'];
 $this->bname =  $_POST['bname']; 
     $this->logo =   $_POST['logo'] ; 
    
}


  function updateBrandData($p,$s) {
      
      $dbc = $this->data->dbc;
      $q = "UPDATE brand SET  brand_name='$this->bname', logo_id = '$this->logo' WHERE brand_id ='$this->brand_id'  ";
       $r = @mysqli_query ($dbc, $q);
      if (mysqli_affected_rows($dbc) == 1) {
 echo '<script language="JavaScript"> window.location="index.php?p=brands&pg=' . $p . '&s=' . $s .  '"</script>';
//echo 'blah';
                
     
  } else {
     echo '<p> sql query trashed </p><p> Here is why: ' . $dbc->error . '</p>'; }

      
          
      
      
} // end update



function initBrandData () {
      $this->brand_id = 0;
 $this->bname =  ""; 
     $this->logo =   0 ; 
      
}  // end init


function addBrandData ($page, $start){
  	$dbc = $this->data->dbc;
	 $q = "INSERT INTO brand(brand_name, logo_id) VALUES ('$this->bname', '$this->logo')";
	 $r = mysqli_query($dbc, $q);
	 		if (mysqli_affected_rows($dbc)  == 1) {
 
	
	 echo '<script language="JavaScript"> window.location="index.php?p=brands&pg=' . $page . '&s=' . $start . '"</script>';

 //  echo ' <tr><td>Image number ' . mysql_insert_id(). ' has been stored!</td></tr>';
  // ?>   
      <!--tr><td> <a href="add_icons.php">Add Another Image</a> </td></tr>
   <tr><td> <a href="view_icons.php">go back to Image gallery</a> </td></tr-->
   <?php
  } else {        echo '<p> sql query trashed </p><p> Here is why: ' . $dbc->error . '</p>';   }
  // mysql_close();
	
} // end add

 	function removeBrandData ($page, $start){
  		$dbc = $this->data->dbc;
		$this->brand_id = $_POST['id'];
                $q = "DELETE FROM brand WHERE brand_id = '$this->brand_id' ";
	        $r = mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc)  == 1) {
 			echo '<script language="JavaScript"> window.location="index.php?p=brands&pg=' . $page . '&s=' . $start . '"</script>';
  		} else {
     			echo '<p> sql query trashed </p><p> Here is why: ' . $q . '</p>'; }
	}  //end delete














 } // end brand
?>
