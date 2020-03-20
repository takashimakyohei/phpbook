<?php
  try{
    // new PDO = (データソース名、ユーザー名、パスワード、オプション)
    
     $db = new PDO('mysql:dbname=bss;host=localhost;charset=utf8','sima','0000');
  } catch(PDOException $e){
    echo 'DB接続エラー :' . $e->getMessage();
  }
  
?>