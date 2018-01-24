<?php
if(isset($_GET['view'])){
   $view = $_GET['view'];
	$vuz = $pdo->prepare ("SELECT id, title, description, picture, source, 
           date_create, UNIX_TIMESTAMP(data_upgrade) as du, autor 
           FROM news WHERE id=?");
          $vuz->bindParam(1, $view);
        $vuz->execute();  
   $row = $vuz->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
       	$title = $row['title'];
       	$desc = $row['description'];
       	$capture = $row['picture'];
			$source = $row['source'];
       	$dc = date('d-m-Y H:i:s', $row['date_create']);
			$du = date('d-m-Y H:i:s', $row['du']);
    echo "<div class='new'>";	       
       echo "<div class='text'><h1>".$title."</h1></div>";
       echo "<div class='text4'>".$desc."</div>";
       echo "<div class='cap1'>"."<img src='$capture' alt='$title'/>"."</div>";
		 echo "<div class='desc'><a href='".$source."'class='menu'>".$button[4]['sour']."</a></div>";
       echo "<div class='text1'><h4>". $button[0]['dc']. " ".$dc."</h4></div>";
		 echo "<div class='text1'><h4>" .$button[4]['du']." ".$du."</h4></div>";
		 echo "<div class='text1'><h4>".$button[4]['aut'] .' '. $row['autor']. "</h4></div>";
     echo "</div>";  
    $vuz = $pdo->prepare ("SELECT login, avatar, commentary, data 
                           FROM coments WHERE id_news=?");
           $vuz->bindParam(1, $view);
         $vuz->execute();
      while ($row = $vuz->fetch(PDO::FETCH_ASSOC)) {
             $login = $row['login'];
             $avatar = $row['avatar'];
             $commentary = $row['commentary'];
             $data = date('d-m-Y H:i:s', $row['data']);      
         echo "<div class='com'>";
            echo "<div class='cap2'>"."<img class='avatar' src='$avatar' alt='no avatar'/>"."</div>";
				echo "<div class='text1'><h3>".$login."</h3></div>";
            echo "<div class='text1'>".$commentary."</div>";
            echo "<div class='text1'>".$data."</div>";   
         echo "</div>";
      }     
}


include 'inc/coment_form.inc.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['com'])){
$vuz = $pdo->prepare ("SELECT avatar FROM users WHERE login=?");
         $vuz->bindParam(1, $_SESSION['login']);
         $vuz->execute();
   $row = $vuz->fetch(PDO::FETCH_ASSOC);
      $avatar = $row['avatar'];            
      $user_login = $_SESSION['login']; 
      $commentary =  clearstr($_POST['com']);
      $data = time();
$vuz = $pdo->prepare ("INSERT INTO coments (login, avatar, commentary, data, id_news)
                            VALUES (?, ?, ?, ?, ?)");
         $vuz->bindParam(1, $user_login);
         $vuz->bindParam(2, $avatar);
         $vuz->bindParam(3, $commentary);
         $vuz->bindParam(4, $data);
         $vuz->bindParam(5, $id);
         $vuz->execute();
		 redirect($_SERVER['REQUEST_URI']);
         exit;  
}