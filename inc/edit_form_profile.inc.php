<form action='<?php echo $_SERVER["REQUEST_URI"]?>' method = "POST" enctype = "multipart/form-data">
  <p class='text1'><?php echo $button[2]['ent']?>:</p>
		<input class="form-field1" type='text' name='login' value="<?php echo $login?>" autocomplete="on"/><br/>
  <p class='text1'><?php echo $button[2]['pass']?>:</p>
		<input class="form-field1" type="password" name="pass" placeholder="password"/><br/>
  <p class='text1'><?php echo $button[2]['pass2']?>:</p>
		<input class="form-field1" type="password" name="pass2" placeholder="retry password"/><br/>
  <p class='text1'><?php echo $button[2]['em']?>:</p>
		<input class="form-field1" type="email" name="email" value="<?php echo $email?>"/><br/>
  <p class='text1'><?php echo $button[2]['av']?>:</p>
		<input type="file" name="ava"/><br/> 
  <p class='text1'><?php echo $button[2]['nm']?>:</p>
		<input class="form-field1" type="text" name="name" value="<?php echo $name?>" autocomplete="on"/><br/>
  <input type="submit" name="edit" value="<?php echo $button[0]['edpr']?>"/>
</form>