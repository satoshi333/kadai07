<?php

//1.DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db25;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データーベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//3．データ表示
$view = "";
if($status==false){
//  execute (SQL実行時にエラーがある場合)
  $error = $stmt->errorInfo();
  exit("SQLエラー:".$error[2]);
  
}else{
//  selectデータの数だけ自動でループしてくれる
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $view .= '<p><a href="'.$result["url"].'" target="_blank">'.$result["name"].'</a>';
  $view .= ' '.$result["coment"];
  $view .= '</p>';
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
