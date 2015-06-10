	<div id="product_form_wrap">
      <form action="index.php" method="post">
              <input type="hidden" name="sp" value="<?php echo $sp?>">
              <input type="hidden" name="pg" value="<?php echo $pg?>">
              <input type="hidden" name="s" value="<?php echo $s?>">
              <input type="hidden" name="p" value="<?php echo $p?>">
              <input type="hidden" id="id" name="id" value="<?php echo $inventory->product_id?>">
			  <div id="field_wrap">
			  	  <label for="brand_id">Brand:</label>
                  <select name="brand_id" id="brand_id" class="one">
	             <option selected value= "<?php echo $inventory->brand_id;?>"><?php echo $brands[$inventory->brand_id] ;?></option> 
	             <?php  foreach ($brands as $key =>$value) { echo "<option value =\"$key\">$value </option> \n";  }  ?>
                </select>
         </div>
         <div id="field_wrap" >
        <label for="line_id">Line:</label>
          <select name="line_id" id="line_id" class="styled_select" >
          <option selected value="<?php echo $inventory->line_id;?>"><?php echo $lines[$inventory->line_id] ;?></option> 
	     <?php  foreach ($lines as $key =>$value) { echo "<option value =\"$key\">$value </option> \n";  }  ?>
          </select>
         </div>
         <div id="field_wrap">
          	<label for="item_number">Item Number</label>
          	<input type="text" name="item_number"  size="10" value="<?php echo $inventory->item_number?>"/>
          	</div>
          	<div id="field_wrap">
          		<label for="name">Name:</label>
			  <input type="text" autocomplete="on" class="one" name="name" size="50" maxlength="50" value="<?php echo $inventory->name ?>" >
</div>
		
			  <div id="field_wrap">
			  <label  for="short_description">Description:</label>
          <input type="text" class="one" name="short_description" value="<?php echo $inventory->short_desc?>"> 
         </div>
        <div id="more_info">
            <label for="long_description">More Information</label>
			  <textarea  id="styled" name="long_description" class="one"><?php echo $inventory->long_desc?></textarea>
         </div>
          <div id ="howto">
			  <label for="howto">Instructions for use:</label>
			  <textarea name="howto"><?php echo $inventory->howto?></textarea>
			 </div>
			 <div id="product_image">
			  <label for="image">image:</label>
			  <input type="text"  name="image" size="4" maxlength="4" value="<?php echo $inventory->image ?>" >
			  </div>
	<input type="submit" class="one" name="submit" value="Submit" /></td>
	
	  </form>
 </div>

			<div id="price_size_wrap">
	<ul id="price_size_list">
		<?php
		$q="SELECT id,size, price FROM size_price WHERE product_id =$inventory->product_id";
		//echo $q;
		
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
?>		
	</ul>
	
	</Div>
	<!--a href="index.php?id="<?php echo $inventory->product_id  ?>"&p=sizeprice&sp=edit&pg=<?php echo $pg?>&s=<?php echo $s?>">edit size and prices</a-->
	<div id="clear_line"></div>	

			
			
			
 

          <div id="popprice" class='popbox'>
          	<form>
  				<a class='open' href='#'>Add a size/price combination </a>
  					<div class='collapse'>
    					<div class='box'>
      						<div class='arrow'></div>
      							<div class='arrow-border'></div>
							       <label id="pop_label" for="size">Size</label>
    								<input type="text"  id="size"name="size" size="10" maxlength="10" value="" ><br>
    								<label for="price">Price</label>
    								<input type="text"  id="price"  name="price" size="10" value="" ><br>
								    <a href="#" class="close">close</a>
    							</div>
  							</div>
						</div>
						</form>
 					</div>
 
	<script type="text/javascript">
$(function() {
 
 $("#price").bind("change", function() {
     $.ajax({
         type: "GET", 
         url: "sizeprice.php",
         data: "id="+$("#id").val()+"&size="+$("#size").val()+"&price="+$("#price").val(),
         success: function(html) {
             $("#price_size_list").html(html);
             $("#price").val(" ");
             $("#size").val(" ");
         }
     });
 });
 });
 </script>
			
<script type="text/javascript">
// this will reset the product line drop down list according to brand id
$(function() {
  	$("#brand_id").bind("change", function() {
    	 $.ajax({
        	 type: "GET", 
         	 url: "change.php",
         	 data: "brand_id="+$("#brand_id").val(),
        	  success: function(html) {
             	$("#line_id").html(html);
        	 }
    	 });
 	});
});
</script>



<script>
// this is the javascript that will allow updating size prize data
$(document).ready(function(){
	$('div.edit').click(function(){
		$('.ajax').html($('.ajax input').val());
		$('.ajax').removeClass('ajax');
		$(this).addClass('ajax');
		$(this).html('<input id="editbox" size="'+$(this).text().length+'" type="text" value="' + $(this).text() + '">');
		$('#editbox').focus();
	  	}
	 );
$('div.edit').keydown(function(event){
	arr = $(this).attr('class').split( " " );
	if(event.which == 13)
	{ 
		$.ajax({    type: "POST",
	    url:"sizepriceupdate.php",
	   data: "value="+$('.ajax input').val()+"&rownum="+arr[2]+"&field="+arr[1],
	   success: function(data){
			$('.ajax').html($('.ajax input').val());
			$('.ajax').removeClass('ajax');
				}});
			 }
		  }
		 );
$('#editbox').live('blur',function(){
	 $('.ajax').html($('.ajax input').val());
	 $('.ajax').removeClass('ajax');
		});
	});
</script>


<script>
	
	$(document).ready(function(){
 $(".delete_class").click(function(){
   var del_id = $(this).attr('id');
   $.ajax({
      type:'GET',
      url:'delete_price.php',
      data:'delete_id='+del_id + '&product_id=' +$("#brand_id").val(),
      success:function(html) {
      	$("#price_size_list").html(html);
      //	price_size_list	
       // if(data) {   // DO SOMETHING
     //   } else { // DO SOMETHING }
      }
   });
 });
});
	
	
</script>