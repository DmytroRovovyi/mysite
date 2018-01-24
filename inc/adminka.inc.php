<?php
if (isset($_GET['adm'])) {
	$admin = $_GET['adm'];
}
else {
	$admin = false;
}

switch ($admin) {
	case 'users':
		echo "Users:";
		$zap = $pdo->prepare ("SELECT id, login, avatar from users");
		     $zap->execute();
		while($row = $zap->fetch(PDO::FETCH_ASSOC)){
			echo "<div class='adm'><a href='index.php?do=edit-user&login=" . $row['login'] . "' class='menu'>" .$row['login']. "</a></div>";
			echo "<div class='adm'><a href='index.php?do=edit-user&login=" . $row['login'] . "&deluser=". $row['id'] ."' class='menu'> Del </a></div>";
		}
		break;
}