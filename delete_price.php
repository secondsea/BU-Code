
<?php

require_once('includes/data.php');
$sd= new SalonData;
    $sd->connect();

  $id = $_GET['delete_id'];
  $product_id = $_GET['product_id'];
$q = "delete from size_price where ID = $id";
 $r = mysqli_query($sd->dbc, $q);
			$q="SELECT id,size, price FROM size_price WHERE product_id =$inventory->product_id";
		//echo $q;
		
  $r = mysqli_query($sd->dbc, $q);

 // if (mysqli_num_rows($r) >= 1){
  	$q="SELECT id,size, price FROM size_price WHERE product_id =$product_id";
		echo $q;
		
		    $r = mysqli_query($sd->dbc, $q);

  if (mysqli_num_rows($r) >= 1){
  echo 'available sizes and prices';
	while (list($id,$size, $price )=mysqli_fetch_array($r, MYSQLI_NUM)){
	?>
          <li>  
                <div  class="edit size <?php echo $id?>"><?php echo  $size ?> </div> 
                <div class="edit price <?php echo $id?>"><?php echo $price?></div>
               <div class="delete_class" id="<?php echo $id ?>"><a  href='#'>Delete</a></div>
                 </li>
		<?php } //end while
  } // end if

 // } // end if delete sucess
  
  ?>		
?>
 