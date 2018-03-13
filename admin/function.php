<?php
function get($p){
  return isset($_REQUEST[$p]) ? $_REQUEST[$p] : '';
}

// for mysql functions
function getOrNull($p){
  return (isset($_REQUEST[$p]) && strlen($_REQUEST[$p]) > 0) ? "'$_REQUEST[$p]'" : "NULL";
}

?>