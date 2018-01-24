<?php
if (isset($_SESSION['login'])){
   	    $login = $_SESSION['login'];
		$vuz = $pdo->prepare ("SELECT login, email, avatar, name, data 
		                       FROM users WHERE login=? OR email=?");
           $vuz->bindParam(1, $login);
           $vuz->bindParam(2, $login);
         $vuz->execute();     
        $row  = $vuz->fetch(PDO::FETCH_ASSOC);
           $log = $row['login'];
           $email = $row['email'];
           $avatar = $row['avatar'];
           $name = $row['name'];
           $data = date('d-m-Y H:i:s', $row['data']);
     echo "<div class='text1'>";	       
       echo "<div class='login'><h1>".$log."</h1></div>";
       echo "<div class='email'><h3>".$email."</h3></div>";
       echo "<div class='ava'>"."<img src='$avatar'/>"."</div>";
       echo "<div class='name'><h3>".$name."</h3></div>";
       echo "<div class='data'><h4>". $button[0]['dc'] ." ".$data."</h4></div>";
       echo "<a href='index.php?do=editprofile' class='menu'>".$button[0]['ed']."</a>";
     echo "</div>";         
}