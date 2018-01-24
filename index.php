<?php
session_start();
if(isset($_SESSION['button'])){
  if($_SESSION['button'] == 'eng'){
    include "inc/eng.inc.php";
    include "inc/title_eng.inc.php";
    }
    elseif($_SESSION['button'] == 'ukr'){
      include "inc/ukr.inc.php";
      include "inc/title_ukr.inc.php";
      }
    }else{
      include "inc/title_ukr.inc.php";
      include "inc/ukr.inc.php";
      }
require "inc/DB.inc.php";
require "inc/lib.inc.php";
include "inc/permissions.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=Convert to UTF-8 without BOM"/>
    <link rel='stylesheet' type='text/css' href='style.css'/>
  </head>
    <body class='bod'>
      <div class='canvas'>
<?php
// print "<pre>";
//print_r('aaaa');
//die();
if(empty($_SESSION['login'])){
    echo "<div class=headerone>";
            include 'inc/headerone.inc.php';
    echo "</div>";
    }else {
      echo "<div class=headertwo>";
            include 'inc/headertwo.inc.php';
      echo "</div>";
}
        echo "<div class=content>";
            include_once 'inc/content.inc.php';
        echo "</div>";
        
        echo "<div class=aside>";
            include_once 'inc/aside.inc.php';
        echo "</div>";
        
        echo "<div class=footer>";
            include_once 'inc/footer.inc.php';
        echo "</div>";
        ?>
      </div>
    </body>
</html>