<?php
//入力チェック（受信確認処理追加）
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST["coment"]) || $_POST["coment"]==""
){
  exit('ParamError');
}
  
  
//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$coment= $_POST["coment"];


//2. DB接続します（エラー処理追加）
try {
  $pdo = new PDO('mysql:dbname=gs_db25;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

$sql = "INSERT INTO gs_bm_table(id, name, url, coment, indate)VALUES(NULL, :a1, :a2, :a3, sysdate())";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $name, PDO::PARAM_STR); 
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);
$stmt->bindValue(':a3', $coment, PDO::PARAM_STR);
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
//  5.index.phpへリダイレクト
  header("Location: index01.php");
  exit;

}
?>
