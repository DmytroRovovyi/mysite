<?php
if (isset($_SESSION['login'])){
  	$log = $_SESSION['login'];
  	$vuz = $pdo->prepare ("SELECT login, pass, email, avatar, name 
  	                       FROM users WHERE login=? OR email=?");
           $vuz->bindParam(1, $log);
           $vuz->bindParam(2, $log);
         $vuz->execute();
  	$row = $vuz->fetch(PDO::FETCH_ASSOC);
  	   $login = $row['login'];
  	   $pass = $row['pass'];
  	   $email = $row['email'];
  	   $capture = $row['avatar'];
  	   $name = $row['name'];
   }  
include 'edit_form_profile.inc.php';     

     
		 
		 if(!empty($_FILES['ava']['tmp_name'])){
        $tmp = $_FILES['ava']['tmp_name'];      
        $name = $_FILES['ava']['name'];
        $name_namber = microtime().$name;  
        move_uploaded_file($tmp,'img/'.$name_namber);
        unlink($capture);          
        $capture = 'img/'.$name_namber; 
     }else{
        $capture = $row['avatar']; 
     }
     if (isset($_POST['edit'])){
     	 if(isset($_POST['login'])){
            $login = $_POST['login'];
            $_SESSION['login'] = $login; 
      }
      else {
           echo $login;
      }        
         if (!empty($_POST['pass2']) && !empty($_POST['pass'])){
         	if (md5(clearstr($_POST['pass2'])) == $row['pass']){
         		$password = md5(clearstr($_POST['pass']));	
         	} else {
         		$password = $row['pass'];
						?>
						<p class='text3'>
							<?php echo  $button[3]['pos']; ?>
							</p>
         		<?php
         	}     
         } else {
         	$password = $row['pass'];
         	if (!empty($_POST['pass2']) xor !empty($_POST['pass'])){
						?>
						<p class='text3'>
							<?php echo  $button[3]['pos1']; ?>
						</p>
         	<?php
         	}         	 
         }
        $email = $_POST['email'];
        $name = $_POST['name'];
        $vuz = $pdo->prepare ("UPDATE users SET login = ?, pass = ?, email = ?, 
                               avatar = ?, name = ? WHERE login=? OR email=?");
   	           $vuz->bindParam(1, $login);
               $vuz->bindParam(2, $password);
               $vuz->bindParam(3, $email);
               $vuz->bindParam(4, $capture);
               $vuz->bindParam(5, $name);
               $vuz->bindParam(6, $log);
               $vuz->bindParam(7, $log);
            $vuz->execute();    
	  redirect('index.php?do=profile');
      exit;
	}