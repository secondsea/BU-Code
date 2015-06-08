<?php

//class to maintain price and size data of a product
class sizePriceData  {
	var $data;
    public $product_id =NULL;
    public $name=NULL;
	public $item=null;
	public $brand_id=null;
	public $brand_name = NULL;
	public $line_id=null;
	public $line_name = NULL;
	public $size=NULL;
	public $price=null;


   
	public function __construct($obj) {
       // this transfers the main database connection object to this object
       $this->data=$obj; 
  		this->link = "";
		$this->queries = array ();
		$this->errors = array ();
    	$this->sqls = array ();
	 } // end function
         
		 
	// get all price - size elements from table	 
	function getSizePriceList() {
		$this->sizePriceList= array();
		$dbc = $this->data->dbc;
		$q="SELECT id,size, price FROM size_price_qty WHERE product_id =$this->product_id";
		$r = mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) >= 1){
			while (list($id,$size, $price )=mysqli_fetch_array($r, MYSQLI_NUM)){
				$this->sizePriceList[$id]['id'] = $id;
				$this->sizePriceList[$id]['size']= $size;
				$this->sizePriceList[$id]['price']=$price;
			} // end while
		} // end if
	} // end function	 
		 
	function fetchProductInfo ( ){
		$dbc = $this->data->dbc;
		if ($this->product_id > 0) {
			$q ="SELECT P.item_number, P.name, P.brand_id,B.brand_name, P.line_id, L.line_name, P.short_description, P.long_description, P.how_to, P.image_id FROM Product as P   JOIN Product_Line as L  ON P.line_id=L.line_id  JOIN Brands as B on P.brand_id=B.brand_id      WHERE  P.id=$this->product_id";
			$r = mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 1) {
              list($this->item_number, $this->name,  $this->brand_id, $this->brand_name, $this->line_id, $this->line_name, $this->short_desc, $this->long_desc, $this->howto,$this->image)=mysqli_fetch_array($r, MYSQLI_NUM);
			} // End of mysqli_num_rows() IF.
			else {
				echo '<p> sql query trashed </p><p> Here is why: ' . $dbc->error . '</p>'; }
			} // .

}		 // end fetch product data
		 
		 
	function repostSizePriceData () {
		$this->product_id = $_POST['id'];
		$this->item_number=$_POST['size'];
		$this->name=$_POST['price'];
	
	}


	function updateSizePrice($data) {
		$dbc = $this->data->dbc;
		if(count($data)){
			$id = $data['rid'];
			unset($data['rid']);
			$values = implode("','", array_values($data));
			$str = "";
			foreach($data as $key=>$val){
				$str .= $key."='".$val."',";
			} // end foreach
			$str = substr($str,0,-1);
			$q="Update size_price_qty SET $str where id = $id"; 
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc)) {
				return $id;
				return 0;
			}	 // end affected rows
			else {
				return 0;
			}// end else
		} // end count data
	} // end update product 3


	
	function addSizePrice($data){
		$dbc = $this->data->dbc;  
		if(count($data)){
			$values = implode("','", array_values($data));
			$columns = implode(",",array_keys($data));
			$q = "INSERT INTO size_price_qty ($columns ) values('$values')";
			
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc)  == 1) {
				return   mysqli_insert_id($dbc); 
				return 0;
			
			} // end if affected rows 1 
			else  {
			 return 0;	
			} // end else affect rows
		} // end count data
	} // end add product 2


	function removeSizePrice ($id){
		$dbc = $this->data->dbc;  
		if($id){
			 $q = "DELETE FROM size_price_qty WHERE id = '$id' ";
			 //echo $q;
			 $r = mysqli_query($dbc, $q);
			 return mysqli_affected_rows($dbc) ;
		} //end if id
	}// end remove product 2 
	
	
   function removeProductData ($page, $start){
  		$dbc = $this->data->dbc;
		$this->product_id = $_POST['id'];
        $q = "DELETE FROM product WHERE id = '$this->product_id' ";
	    $r = mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc)  == 1) {
 			echo '<script language="JavaScript"> window.location="index.php?p=inventory&pg=' . $page . '&s=' . $start . '"</script>';
  		} else {
     			echo '<p> sql query trashed </p><p> Here is why: ' . $q . '</p>'; }
	}  //end delete

	
function update_column($data){
		$dbc = $this->data->dbc;
		if(count($data)){
			$id = $data['rid'];
			unset($data['rid']);
			$key1=key($data);
			$key2=$data[key($data)];
			$q="Update Product set $key1='$key2' where id =$id "; 
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc)) {
				return $id;
				return 0;
			} // end affected rows
 		} // end count data 
	}// end update column
	
	
	function error($act){
		return json_encode(array("success" => "0","action" => $act));
	}
	
	
	
//  ****************************************************************************************
 } // end size price class
 
 ?>
 