<?php
if (empty($_SESSION['login'])){
echo "<div class='menu2'>";
    echo "<a href ='index.php?do=registr' class='menu'>".$button[0]['reg']."</a>";
echo "</div>";
}else{
    echo "<div class='menu2'>";
    echo "<a href ='index.php?do=exit' class='menu'>".$button[0]['exit']."</a>";
    echo "</div>";
}
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "<div class='menu3'>";
    echo "<a href ='index.php?do=eng' class='menu'>".$button[0]['eng']."</a>";
    echo "<a href ='index.php?do=ukr' class='menu'>".$button[0]['ukr']."</a>";
echo "</div>";