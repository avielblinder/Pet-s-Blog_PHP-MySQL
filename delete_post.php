<?php

session_start();
require_once 'backend/helpers.php';

$pid = $_GET['pid'] ?? null;
$uid = $_SESSION['user_id'] ?? null;

if( $uid && $pid && is_numeric($pid) ){//checking if its a number
  
  $link =  mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB);
  $pid = mysqli_real_escape_string($link , $pid);
  $sql = "DELETE FROM posts WHERE id=$pid AND user_id=$uid";
  $result = mysqli_query($link,$sql);
  
}

header('location:blog.php');



#