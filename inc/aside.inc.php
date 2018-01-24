<?php
echo "<div class='menu3'>";
if(empty($_SESSION['login'])){
    include "inc/autoconfiguration.inc.php";
    }else {
    echo "</br></br></br>";
    if (check_access($_SESSION['login'], 'add news')) {
        echo "<a href ='index.php?do=add' class='menu'>".$button[0]['add']."</a>";
        echo "</br></br></br>";
    }
    echo "<a href ='index.php?do=new' class='menu'>".$button[0]['new']."</a>";
    echo "</br></br></br>";
    echo "<a href ='index.php?do=profile' class='menu'>".$button[0]['con']."</a>";
    echo "</br></br></br>";
    if (check_access($_SESSION['login'], 'adminka')) {
        echo "<a href ='index.php?do=admin&adm=users' class='menu'>".$button[0]['adm']."</a>";
        echo "</br></br></br>";
    }
    }
    echo "</div>";
echo "<div class='menu4'>";
include "inc/Weathercurrency.inc.php";
echo "</div>";