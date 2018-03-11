<?php
function get($p){
  return isset($_REQUEST[$p]) ? $_REQUEST[$p] : '';
}
?>