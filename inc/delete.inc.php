<?php   
    /*Видалення записів з БД*/
    if (isset($_GET['del'])){
  	  $zap = $pdo->prepare ("SELECT picture FROM news"); 
  	         $zap->execute(); 
       $row = $zap->fetch(PDO::FETCH_ASSOC);      	  
   	   unlink($row['picture']);
  	   $del = $_GET['del'];
      if ($del){        	
      	$zap = $pdo->prepare ("DELETE FROM news WHERE id=?");
               $zap->bindParam(1, $del, PDO::PARAM_INT);
               $zap->execute();  
		redirect($_SERVER['SCRIPT_NAME']);	    	
      exit;
      }  
  }      
    /*Видалення записів з БД*/