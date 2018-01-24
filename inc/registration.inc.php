<?php
$vuz = $pdo ->prepare("SELECT login,email FROM users");
    $vuz ->execute();
    $row = $vuz->fetch(PDO::FETCH_ASSOC);
    $log = $row['login'];
    $mail = $row['email'];

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){      
     if (!empty($_FILES['avatar']['tmp_name'])) { 
      $tmp = $_FILES['avatar']['tmp_name'];      
      $name = $_FILES['avatar']['name'];
      $name_namber = microtime().$name;   
      move_uploaded_file($tmp,'img/'.$name_namber);
      $avatar = 'img/'.$name_namber;
     } 
     else{
      $avatar = '';
     }
     $login = clearstr($_POST['login']);
     $pass = md5(clearstr($_POST['pass']));
     $pass2 = md5(clearstr($_POST['pass2']));
     $email = clearstr($_POST['email']);
     $name = clearstr($_POST['name']);
     $data = time();
     if($log!==$login){
          if ($pass ==$pass2){
               if ($email !== $mail){
                    if(!empty($avatar)){
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $vuz = $pdo -> prepare("INSERT INTO users (login, pass, email, avatar, name, data)
                              VALUES (?, ?, ?, ?, ?, ?)");
            $vuz ->bindParam(1, $login);
            $vuz ->bindParam(2, $pass);
            $vuz ->bindParam(3, $email);
            $vuz ->bindParam(4, $avatar);
            $vuz ->bindParam(5, $name);
            $vuz ->bindParam(6, $data);
        $vuz ->execute();
        $ud = $pdo->lastInsertId();
        $gd = 2;
        $sqlvuz = $pdo->prepare("INSERT INTO user_roles (gd, ud) VALUES (?, ?)");
            $sqlvuz ->bindParam(2, $ud, PDO::PARAM_INT);
            $sqlvuz ->bindParam(1, $gd, PDO::PARAM_INT);
                $sqlvuz ->execute();
			 redirect($_SERVER['SCRIPT_NAME']);
       exit;
                }else {
         ?>           
         <p class='text3'>
               <?php echo $button[1]['mal'];?>
               </p>
              <?php }
               }else { ?>
                    <p class='text3'>
                  <?php echo $button[1]['avavv'];?>
                  </p>
                    <?php }
               }else { ?>
               <p class='text3'>
               <?php echo $button[1]['mel'];?>
               </p>
               <?php }
               }else { ?>
                    <p class='text3'>
                    <?php echo $button[1]['pas'];?>
                    </p>
                    <?php }
     }else { ?>
        <p class='text3'>
        <?php echo $button[1]['lo'];?>
        </p>
        <?php }
     
}
?>
<div class='text1'>
<form action='<?php echo $_SERVER["REQUEST_URI"]?>' method="POST" enctype="multipart/form-data">
       <p class='text1'><?php echo $button[2]['ent']?>:</p>
       <input class="form-field1" type="text" name="login" placeholder="login" autocomplete="on"  required/>
       <p class='text1'><?php echo $button[2]['pass']?>:</p>
       <input class="form-field1" type="password" name="pass" placeholder="password" required/>
       <p class='text1'><?php echo $button[2]['pass2']?>:</p>
       <input class="form-field1" type="password" name="pass2" placeholder="retry password" required/>
       <p class='text1'><?php echo $button[2]['em']?>:</p>
       <input class="form-field1" type="email" name="email" placeholder="e-mail" required/>
       <p class='text1'><?php echo $button[2]['av']?>:</p>
       <input type="file" name="avatar" /><br/> 
       <p class='text1'><?php echo $button[2]['nm']?>:</p>
       <input class="form-field1" type="text" name="name" placeholder="name" autocomplete="on" required/><br/><br/> 
       <input  type="submit" name="reg" value="<?php echo $button[0]['reg']?>" style="background:#8b8006; color:#dfe6ed;"/>
</form>
</div>