<?php
//データベース接続
function dbConnect(){
  $dsn = 'mysql:host=localhost;dbname=Blog_app;charset=utf8';
  $user = 'blog_user';
  $pass = 'kae0428';
  try{
    $dbh = new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ]);
    }catch(PDOException $e){
      echo '接続失敗'.$e->getMessage();
      exit();
    };
    return $dbh;
}

//データベース接続
function getAllBlog(){
        $dbh= dbConnect();
        //SQLの準備
        $sql = 'SELECT*FROM blog';
        //SQLの実行
        $stmt = $dbh->query($sql);
        //SQLの結果を受け取る
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
}
//取得したデータを表示
$blogData = getAllBlog();

//カテゴリー名表示
function setcreategoryName($creategory){
  if($creategory === '1'){
    return'ブログ';
  }elseif($creategory === '2'){
    return '日常';
  }else{
    return'その他';
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ一覧</title>
</head>
<body>
<h2>ブログ一覧</h2>
    <table>
      <tr>
        <th>No</th>
        <th>タイトル</th>
        <th>カテゴリ</th>
      </tr>
      <?php var_dump($blogData)?>
      <?php foreach($blogData as $column):?>
      <tr>
        <td><?php  echo($column['id']); ?></td>
        <td><?php  echo($column['title']); ?></td>
        <td><?php  echo setcreategoryName($column['creategory']); ?></td>
      </tr>
      <?php endforeach;?>
    </table>
</body>
</html>