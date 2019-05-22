<?php
require_once './controller/Routes.php';
if($_SERVER['SERVER_PORT'] !== 443 &&
   (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')) {
  header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit;
}
if(!isset($_SESSION)){
    session_start();
    
 }
Routes::route();