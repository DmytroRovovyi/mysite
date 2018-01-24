<?php
function clearstr($data){
       return trim(strip_tags($data));
}

function redirect($url) {
  // header('Location: ' . $url);
  print '<script>window.location = "' . $url . '";</script>';
}