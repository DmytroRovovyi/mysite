<?php
//виведення інформації про користувача
if (!empty($_GET['login'])){
  	    $login = $_GET['login'];
	    $zap = $pdo->prepare ("SELECT id, login, pass, email, avatar, name, data 
		                       FROM users WHERE login=?");
	           $zap->bindParam(1, $login);
	         $zap->execute();   
        $row  = $zap->fetch(PDO::FETCH_ASSOC);
           $id = $row['id'];
           $login = $row['login'];
           $email = $row['email'];
           $avatar = $row['avatar'];
           $name = $row['name'];
           $data = date('d-m-Y H:i:s', $row['data']);
      echo "<div id='prof'>";	       
      echo "<div id='login'>".$login."</div>";
      echo "<div id='email'>".$email."</div>";
      echo "<div id='ava'>"."<img src='$avatar'/>"."</div>";
      echo "<div id='name'>".$name."</div>";
      echo "<div id='data'>". $button[0]['dc'] ." ".$data."</div>";
      echo "</div>";         
   }
   else {
   	die('page not found');
   }

	if (isset($_POST['edit'])) {
		/////
		if (!empty($_FILES['avatar']['tmp_name'])) {
			$tmp = $_FILES['avatar']['tmp_name'];      
			$name = $_FILES['avatar']['name'];
			$name_namber = microtime().$name;  
			move_uploaded_file($tmp,'img/'.$name_namber);
			unlink($avatar);          
			$avatar = 'img/'.$name_namber; 
		}
		else {
			$avatar = $row['avatar']; 
		}

		$valid = true;

		if (!empty($_POST['pass'])){
			$password = md5(clearstr($_POST['pass']));
		} else {
			$password = $row['pass'];
		}
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	        if ($email != $_POST['email']) {
	        	$query = $pdo->prepare ('SELECT COUNT(*) as count FROM users 
	        		                     WHERE email = ?');
	        	         $query->bindParam(1, $_POST['email']);
	        	       $query->execute();  
	        	$res_email = $query->fetch(PDO::FETCH_ASSOC);
	        	if ($res_email['count']) {
	        		 echo 'Your e-mail is used';
	        		 $valid = false;
	        	}
	        	else {
	        		$email = $_POST['email'];
	        	}
	        }
		}
		else {
			echo "E-mail incorrect";
			$valid = false;
		}

       
       if (!empty($_POST['nam'])){
       	  $name = $_POST['nam'];
       }
       else{
       	  $name = $row['name']; 
       } 
		
		
		if (isset($_POST['roles'])) {
        if ($valid) {
            $roles = array_keys($_POST['roles']);
            if (!$roles) $roles = array(2);
            $query = $pdo->prepare('SELECT id FROM users WHERE login = ? LIMIT 1');
            $query->bindParam(1, $login);
            $query->execute();
            $uid = $query->fetchColumn(0);
            $query = $pdo->prepare('
              DELETE FROM user_roles 
              WHERE ud = ?
            ');
            $query->bindParam(1, $uid);
            $query->execute();

            foreach ($roles as $rid) {
                $query = $pdo->prepare('INSERT INTO user_roles VALUES (?, ?)');
                $query->bindParam(1, $rid);
                $query->bindParam(2, $uid);
                $query->execute();
            }
			}
		}
		else {
			echo 'Please select roles';
			$valid = false;
		}

		if ($valid) {
			$zap = $pdo->prepare ("UPDATE users SET pass = :pass, email = :email, 
				                   avatar = :avatar, name = :name WHERE id = :id");
			    $zap->execute(array(':pass'=>$password, ':email'=>$email, 
			    	                ':avatar'=>$avatar, ':name'=>$name, ':id'=>$id));    
			redirect($_SERVER['REQUEST_URI']);	 
			die;
		} 
	}


	$user_roles = array();
	$zap = $pdo->prepare ("SELECT * FROM roles");
	       $zap->execute();	         
	while ($row = $zap->fetch(PDO::FETCH_ASSOC)){                 
		$user_roles[$row['id']]['role'] = $row['name'];
	}   

	$zap = $pdo->prepare ('
    SELECT ur.gd, r.name, COUNT(u.id) AS enable FROM user_roles ur 
    INNER JOIN roles r ON ur.gd = r.id
    LEFT JOIN users u ON ur.ud = u.id
    WHERE u.login = ? 
    GROUP BY r.id
  ');
	       $zap->bindParam(1, $login);
	     $zap->execute();  
	while($row = $zap->fetch(PDO::FETCH_ASSOC)){
		$gid = $row['gd'];
		$user_roles[$gid]['enable'] = $row['enable'];
	}
?>
<form action='<?php echo $_SERVER["REQUEST_URI"]?>' method = "post" enctype = "multipart/form-data">   
   <label><?php echo $button[2]['pass']?>:</label><br/>
   <input type="password" name="pass" placeholder="password"/><br/>
   <label><?php echo $button[2]['em']?>:</label><br/>
   <input type="email" name="email" value="<?php echo $email?>"/><br/>
   <label><?php echo $button[2]['av']?>:</label><br/>
   <input type="file" name="avatar"/><br/> 
   <label><?php echo $button[2]['nm']?>:</label><br/>
   <input type="text" name="name" value="<?php echo $name?>" autocomplete="on"/><br/>  
   <?php        
       $index = 0;
   foreach ($user_roles as $gd => $value) {
   	    $group = $value['role'];
        $groupIndex = $value['role'] . "$index";
        $checked = ""; 
       if (isset($value['enable'])){
           $checked = "checked";
           }
          echo "<p><input type='checkbox' name='roles[$gd]' value='$group' $checked> $group";
       $index++;          
   }
   ?>
   </br><input type="submit" name="edit" value="<?php echo $button[0]['edpr']?>"/>
</form>

<?php       	
    $zap = $pdo->prepare ("SELECT coments.login, coments.commentary, coments.data, news.title, news.id, coments.id_com  
    	                   FROM coments INNER JOIN news ON news.id = coments.id_news WHERE login=?");
           $zap->bindParam(1, $login);
         $zap->execute();
      while ($row = $zap->fetch(PDO::FETCH_ASSOC)) {
             $login = $row['login'];
             $commentary = $row['commentary'];
             $data = date('d-m-Y H:i:s', $row['data']);
             $title = $row['title'];
             $id = $row['id'];
             $id_com = $row['id_com'];      
         echo "<div id='com'>";
            echo "<div id='login'>".$login."</div>";
            echo "<div id='title'>";
	    echo "<a href='index.php?do=viewer&view=".$id."'>".$title."</a>";
	    echo "</div>";
            echo "<div id='comment'>".$commentary."</div>";
            echo "<div id='data'>".$data."</div>";
            echo "<div class='sendcom'>";
	    echo "<a href='index.php?do=edit-user&login=" . $row['login'] . "&sendcom=". $row['id_com'] ."'> Send </a>";
	    echo "</div>";
	    echo "<div class='delcom'>";
            echo "<a href='index.php?do=edit-user&login=" . $row['login'] . "&delcom=". $row['id_com'] ."'> Del </a>";
	    echo "</div>";
         echo "</div>";
	 
         
     }
     $permission = 1;    
   if (!empty($_GET['sendcom'])){
	$zap = $pdo->prepare ("UPDATE coments SET permission=? WHERE id_com=?");
	       $zap->bindParam(1, $permission);
	       $zap->bindParam(2, $_GET['sendcom']);
         $zap->execute();
   }
   if (!empty($_GET['delcom'])){
    $zap = $pdo->prepare ("DELETE FROM coments WHERE id_com=?");
	       $zap->bindParam(1, $_GET['delcom']);
         $zap->execute();     	
   }
   if (!empty($_GET['deluser'])){
       unlink($avatar);
    $zap = $pdo->prepare ("DELETE FROM users WHERE id=?");
	       $zap->bindParam(1, $_GET['deluser']);
         $zap->execute();
    $delquery = $pdo->prepare ('DELETE FROM user_roles WHERE ud = ?');
		   $delquery->bindParam(1, $_GET['deluser']);
		 $delquery->execute();
		 redirect('index.php?do=admin&adm=users');
      exit;      
  }