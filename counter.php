<?php
if ($_POST) {
  $kv;
  foreach ($_POST as $key => $value) {
    $kv = $value;
  }
  $query_string = $kv*2; 
}else {
  $query_string = $_SERVER['QUERY_STRING'];
}
echo $query_string;
?>