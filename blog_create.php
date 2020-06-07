<?php

require_once('dbc.php');
  $blogs = $_POST;
  if(empty($blogs['title'])){
    exit('タイトルを入力して下さい');
  }
  if(mb_strlen($blogs['title']) > 191){
    exit('タイトルは191文字以下にして下さい');
  }
  if(empty($blogs['content'])){
    exit('本文を入力して下さい');
  }
  if(empty($blogs['category'])){
    exit('カテゴリーを入力して下さい');
  }
  if(empty($blogs['publish_status'])){
    exit('公開ステータスを入力して下さい');
  }
  
  $dbc = new Dbc();
  $dbc->blogCreate($blogs);

?>