<div class='text1'>
<form action="<?= $_SERVER["REQUEST_URI"]; ?>" method="post" enctype="multipart/form-data">
<p class='text1'><?php echo $button[2]['zag']?>:</p>
    <input class="form-field1" type='text' name='title' value="<?php echo $title?>" />
<p class='text1'><?php echo $button[2]['tex']?>:</p>
    <textarea class="form-field2" name="description" cols='100' rows='7'><?php echo $desc?></textarea>
<p class='text1'><?php echo $button[2]['pic']?>:</p>
    <input type='file' name='upload'/>
<p class='text1'><?php echo $button[2]['dge']?>:</p>
    <input class="form-field1" type='text' name='source' value="<?php echo $source?>"/><br/><br/>
    <input type='hidden' name='id' value="<?php echo $_GET['ed']?>"/>
    <input type="submit" name="but" value="<?php echo $button[2]['dob']?>" style="background:#8b8006; color:#dfe6ed;"/>
</form>
</div>