<?php
$title = 'Головна сторінка';

if(isset($_GET['do'])){
	$ids = strtolower(strip_tags(trim($_GET['do'])));
switch ($ids) {
	case 'add':
		$title = 'Додати Новину';
		break;
	case 'new':
        $title = 'Новини';
        break;
	case 'registr':
	    $title = 'Реєстрація';
		break;
	case 'profile':
	    $title = 'Профіль';
		break;        			       
    case 'editprofile':
	    $title = 'Редагування профіля';
		break;			
    }
}