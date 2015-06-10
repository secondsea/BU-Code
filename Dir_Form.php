
<div id="small_form_wrap">
    <form action="<?php echo $action?>.php" method="post">
       <input type="hidden" name="id" value="<?php echo $dd->dir_id?>">
       <label for="name">Directory Name</label>
    <input type="text" name="name" size="50" maxlength="50" value="<?php echo $dd->dir_name ?>" ><br>
   <input type="submit" name ="submit" value="Submit" />
   </form>
   </div>

