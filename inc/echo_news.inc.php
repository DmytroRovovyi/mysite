<?php
//Пагінація
include "inc/pagination.inc.php";

$stmt = $pdo->prepare("SELECT id, title, description, picture, source,
							date_create, UNIX_TIMESTAMP(data_upgrade) as du, autor
							   FROM news ORDER BY id LIMIT ?,?");
		$stmt->bindParam(1, $offset, PDO::PARAM_INT);
		$stmt->bindParam(2, $show_page, PDO::PARAM_INT);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $row['id'];
    $title = $row['title'];
    $desc = $row['description'];
    $capture = $row['picture'];
    $source = $row['source'];
    $dc = date('d-m-Y H:i:s', $row['date_create']);
    $du = date('d-m-Y H:i:s', $row['du']);
	
	echo "<p >";
    echo "<a href='index.php?do=viewer&view=".$id."' class='menu'>".$title."</a>";
    echo "<div class='text1'><h3>".str_cut($desc). "</h3></div>";
    echo "<div class='cap'>"."<img id='min' src='$capture' alt='$title'/>"."</div>";
    echo "<div class='desc'><a href='".$source."' class='menu'>".$button[4]['sour']."</a></div>";
    echo "<div class='text1'><h4>".$button[0]['dc']." " .$dc."</h4></div>";
    echo "<div class='text1'><h4>".$button[4]['du']." "  .$du."</h4></div>";
	echo "<div class='text2'><h4>".$button[4]['aut'] .' '. $row['autor']. "</h4></div>";
    echo "<div class='edit'>";
	if (check_access($_SESSION['login'], 'add news')) {
    echo "<a href='index.php?do=edit&ed=".$id."' class='menu'>редагувати</a>";
	}
    echo "</div>";
	echo "<div class='del'>";
	if (check_access($_SESSION['login'], 'add news')) {
    echo "<a href='index.php?do=delete&del=".$id."' js onclick=\"return confirm('are u shure?') ? true : false;\" class='menu'>видалити</a>";
	}
    echo "</div>";
	echo "</p>";
    
}
echo "<div class='pag'>";
    // Робим панельку з ссилками на сторінки, якщо потрібна пагінація
    if ($rows_max > $show_page){
    	$r = 1;
    	while ($r <= ceil($rows_max/$show_page)){
    		if ($r != $this_page){
    			echo '<a href="?do=new&page=' . $r . '" title="Go to page' . $r . ' "class=knopka>'.  $r  .'</a>';
    		}
    		else {
    			echo '<b class=knopka>' . $r . '</b>'; // Якщо це поточна сторінка - тоді ссилка на саму себе не потрібна
    		}
    		$r++;	
    	}
    }
  echo "</div>";