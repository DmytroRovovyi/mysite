<?php
/*Редагування записів в БД*/
if (isset($_GET['ed'])){
  $ed = $_GET['ed'];
  $zap = $pdo->prepare ("SELECT id, title, description, picture, source FROM news 
                         WHERE id=?");
         $zap->bindParam(1, $ed);
         $zap->execute();
  $row = $zap->fetch(PDO::FETCH_ASSOC); 
  $title = $row['title'];
  $desc = $row['description'];
  $capture = $row['picture'];
  $source = $row['source'];
  include 'edit_form.inc.php';
  }
    
    
    if(!empty($_FILES['upload']['tmp_name'])){
        $tmp = $_FILES['upload']['tmp_name'];      
        $name = $_FILES['upload']['name'];
        $name_namber = microtime().$name;  
        move_uploaded_file($tmp,'img/'.$name_namber);
        unlink($row['picture']);          
        $capture = 'img/'.$name_namber; 
    } 
    else{
        $capture = $row['picture']; 
    }
    if (isset($_POST['but'])){        
        $ed = $_POST['id'];
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $source = $_POST['source'];
        $zap = $pdo->prepare ("UPDATE news SET title = ?, description = ?, picture = ?, source = ?  
                               WHERE id=?");
               $zap->bindParam(1, $title);
               $zap->bindParam(2, $desc);
               $zap->bindParam(3, $capture);
               $zap->bindParam(4, $source);
               $zap->bindParam(5, $ed);
               $zap->execute(); 
		redirect('index.php?do=new');
        exit;
		}
	/*Редагування записів в БД*/