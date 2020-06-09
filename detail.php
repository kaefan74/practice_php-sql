<?php
  require_once('blog.php');
  $blog = new Blog();
  $result = $blog->getById($_GET['id']);
  // $result = getBlog($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ詳細</title>
</head>
<body>
  <h2>ブログ詳細
  <h3>タイトル：<?php echo $result['title']?></h3>
  <p>投稿日時：<?php echo $result['post_at']?></p>
  <p>カテゴリ：<?php echo $blog->setcreategoryName($result['creategory'])?></p>
  <hr>
  <p>本文：<?php echo $result['content']?></p>
  <p><a href="index.php">戻る</a></p>
</body>
</html>