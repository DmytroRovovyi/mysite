<?php
/*Збереження запису в БД*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){      
     if (!empty($_FILES['upload']['tmp_name'])) { 
      $tmp = $_FILES['upload']['tmp_name'];      
      $name = $_FILES['upload']['name'];
      $name_namber = microtime().$name;   
      move_uploaded_file($tmp,'img/'.$name_namber);
      $capture = 'img/'.$name_namber;
     } 
     else{
      $capture = '';
     } 
      $title = clearstr($_POST['title']);
      $desc = clearstr($_POST['description']);
      $source = clearstr($_POST['source']);
      $dc = time();
      $user_login = $_SESSION['login'];
      

      $zap = $pdo->prepare ("INSERT INTO 
                              news (title, description, picture, source, autor, date_create)
                             VALUES (?, ?, ?, ?, ?, ?)");
           $zap->bindParam(1, $title);
           $zap->bindParam(2, $desc);
           $zap->bindParam(3, $capture);
           $zap->bindParam(4, $source);
           $zap->bindParam(5, $user_login);
           $zap->bindParam(6, $dc);
           $zap->execute();
		   redirect($_SERVER['REQUEST_URI']);	 
         exit;
         
    }
    /*Збереження запису в БД*/
    
?>
<div class='text1'>
<form action="<?= $_SERVER["REQUEST_URI"]; ?>" method="post" enctype="multipart/form-data">
<p class='text1'><?php echo $button[2]['zag']?>:</p>
    <input class="form-field1" type="text" name="title" />
<p class='text1'><?php echo $button[2]['tex']?>:</p>
    <textarea class="form-field2" name="description" cols="50" rows="5"></textarea>
<p class='text1'><?php echo $button[2]['pic']?>:</p>
    <input type="file" name="upload" />
<p class='text1'><?php echo $button[2]['dge']?>:</p>
    <input class="form-field1" type="text" name="source"/><br/><br/>
    <input type="submit" value="<?php echo $button[2]['dob']?>" style="background:#8b8006; color:#dfe6ed;"/>
</form>
</div>