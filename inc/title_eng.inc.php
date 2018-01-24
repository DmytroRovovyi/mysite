<?php
$title = 'Home page';

if(isset($_GET['do'])){
	$ids = strtolower(strip_tags(trim($_GET['do'])));
switch ($ids) {
	case 'add':
		$title = 'Add News';
		break;
	case 'new':
        $title = 'News';
        break;
	case 'registr':
	    $title = 'Registration';
		break;
	case 'profile':
	    $title = 'Profile';
	    break;        			       
    case 'editprofile':
	    $title = 'Edit profile';
	    break;			
}
}