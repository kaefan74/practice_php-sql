<?php
  //データベースをサーバーに接続するためのファイル
  require_once  'env.php';
  
  function connect(){
    $host = DB_HOST;
    $db = DB_Name;
    $user = DB_USER;
    $pass = DB_PASS;
    //データソース名DSN(接続情報に対して付けられる識別用の名前)
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    try{
      $pdo = new PDO($dsn,$user,$pass ,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
      return $pdo;
      
    }catch(PDOException $e){
      echo'接続失敗です'.$e->getMessage();
      exit();
    }
  }
 
?>