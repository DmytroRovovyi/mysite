<form class="form-container" action='<?php echo $_SERVER["REQUEST_URI"]?>' method="POST">
<div class="form-title"><h2></h2></div>
<div class="form-title"><?php echo $button[2]['login']?>:</div>
<input class="form-field" type="text" name="login" placeholder="login or email" autocomplete="on"/><br />
<div class="form-title"><?php echo $button[2]['password']?>:</div>
<input class="form-field" type="password" name="pass" placeholder="Password"/><br />
<div class="submit-container">
<input class="submit-button" type="submit" name="aut" value="<?php echo $button[2]['exit']?>"/>
</div>
</form>