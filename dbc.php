<?php
Class Dbc
{
  //データベース接続
  function dbConnect() {
    $dsn = 'mysql:host=localhost;dbname=Blog_app;charset=utf8';
    $user = 'blog_user';
    $pass = 'kae0428';

    try{
      $dbh = new \PDO($dsn,$user,$pass,[
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]);
      }catch(PDOException $e){
        echo '接続失敗'.$e->getMessage();
        exit();
      };
      return $dbh;
  }

  function getAllBlog(){
      $dbh= $this->dbConnect();
      //SQLの準備
      $sql = 'SELECT*FROM blog';
      //SQLの実行
      $stmt = $dbh->query($sql);
      //SQLの結果を受け取る
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $result;
      $dbh = null;
    }

  //カテゴリー名表示
  function setcreategoryName($creategory){
    if($creategory === '1'){
      return'日常';
    }elseif($creategory === '2'){
      return 'プログラミング';
    }else{
      return'その他';
    }
  }

  function getBlog($id){
    if(empty($id)){
      exit('IDが不正です');
      }
    $dbh = $this->dbConnect();

    $stmt = $dbh->prepare('SELECT*FROM blog where id=:id');
    $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if(!$result){
      exit('ブログがありません');
    }
    return $result;
  }
  function blogCreate($blogs){
      $sql = 'INSERT INTO
      blog(title,content,creategory,publish_status)
      VALUES
      (:title,:content,:category,:publish_status)';
      
      $dbh = $this->dbConnect();
      $dbh->beginTransaction();
      try{
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
      $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
      $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_INT);
      $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();
      echo 'ブログを投稿しました';
      }catch(PDOException $e){
      $dbh->rollBack();
      exit($e);
      }
  }
}
?>


