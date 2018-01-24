<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $login = clearstr($_POST['login']);
  $pass  = clearstr($_POST['pass']);
  if (!empty($login) && !empty($pass)){
        $pass = md5($pass);   
        $vuz = $pdo->prepare ("SELECT id, login, pass, email, avatar, name, data 
        FROM users WHERE login=? OR email=?");
        $vuz->bindParam(1, $login);
        $vuz->bindParam(2, $login);
        $vuz->execute();
        $row = $vuz->fetch(PDO::FETCH_ASSOC);
        $password = $row['pass'];
        $e_mail = $row['email'];
        $log = $row['login'];        
        if ($pass == $password) {
          $_SESSION['login'] = $log;
		  redirect($_SERVER['SCRIPT_NAME']);
        } else {
          ?>
          <p class='text3'>
          <?php echo  $button[2]['lagin'];?>
          </p>
          <?php }
    } else {
      ?>
      <p class='text3'>
<?php echo  $button[2]['lagin'];?>
      </p>
<?php } 
 }
include "inc/exit.ini.php";