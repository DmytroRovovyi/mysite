<?php
if(isset($_SESSION['login'])){
    $login = $_SESSION['login'];
   }else{
   	 $login = '';
   }
if(isset($_GET['do'])){
    switch($ids){
    case 'add':
        if (!check_access($_SESSION['login'], 'add news')) {
            echo "<div class='error'>".$button[3]['erro']."</div>";
        }
        else {
            include 'inc/addnews.inc.php';
        }
        break;
    case 'new':
		include 'inc/echo_news.inc.php';
        break;
    case 'delete':
		if (!check_access($_SESSION['login'], 'delete')) {
            echo "<div class='error'>".$button[3]['erro']."</div>";
        }
        else {
			include 'inc/delete.inc.php';
		}
        break;
    case 'edit':
		//print "<pre>";
		//print_r('aaaa');
		//die();
		if (!check_access($_SESSION['login'], 'edit news')) {
            echo "<div class='error'>".$button[3]['erro']."</div>";
        }
        else {
			include 'inc/editnews.inc.php';
		}
		break;
	case 'viewer':
			include 'inc/view_news.inc.php';
		break;
	 case 'registr':
        include 'inc/registration.inc.php';
		break;
	case 'profile':
        include 'inc/User_profile.inc.php';
		break;
	case 'editprofile':
        include 'inc/edit_profile.inc.php';
		break;
	case 'exit':
        include 'inc/exit_from_profile.inc.php';
		break;
	case 'admin':
		if (!check_access($_SESSION['login'], 'adminka')) {
           echo "<div class='error'>".$button[3]['erro']."</div>";
        }
        else {
			include 'inc/adminka.inc.php';
		}
		break;
	case 'edit-user':
		if (!check_access($_SESSION['login'], 'edit adminka')) {
            echo "<div class='error'>".$button[3]['erro']."</div>";
        }
        else {
			include 'inc/edit_adminka.inc.php';
		}
		break;
    case 'eng':
	     $_SESSION['button'] = 'eng';
		 redirect($_SERVER['SCRIPT_NAME']);
	    break;
	case 'ukr':
	     $_SESSION['button'] = 'ukr';
		 redirect($_SERVER['SCRIPT_NAME']);
	    break;
    }
}else{
	if(isset($_SESSION['button'])){
		if($_SESSION['button'] == 'eng'){
            include "inc/content_eng.inc.php";
}elseif($_SESSION['button'] == 'ukr'){
            include "inc/content_ukr.inc.php";
}
}else{
    include "inc/content_ukr.inc.php";
}
}