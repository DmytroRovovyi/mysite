<?php
function str_cut($text) {
    $end = '...';
    if (strlen($text) > 50){
      $text_cut = substr_replace($text, $end, 100);
      return $text_cut;
    }
    return $text;
  } 
$zap = $pdo->prepare ("SELECT COUNT(id) AS count FROM news");
  $zap->execute(); 
  $rows_max = $zap->fetchColumn(); // Скільки взагалі новин в базі
  $show_page = 2; // Скільки новин показати користувачу
  if (isset($_GET['page'])){
  $this_page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);// Номер поточної сторінки
  }
    if (isset($this_page)){
        $offset = (($show_page * $this_page) - $show_page);
    }
    else {
    	$this_page = 1; // Ставим одиницю (перша сторінка) якщо не переданий параметр $_GET['page']
    	$offset = 0;
		}