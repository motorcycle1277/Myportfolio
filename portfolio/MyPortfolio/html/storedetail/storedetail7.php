<?php
session_start();
require_once('../config.php');
//すでにログインしているユーザーの処理
if(!isset($_SESSION['EMAIL'])){
  echo "ログインしてください。<br>";
  echo "<a href='../../index.php'>トップページに戻る</a><br>";
  echo "<a href='../signin.php'>ログインページに戻る</a><br>";
  //プログラム終了
  exit;
}
//データベースへ接続
try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
  echo $e->getMessage().PHP_EOL;
}?>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>カフェ勉 for auwifi|店舗詳細</title>
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
<?php
require_once('header.php');
//ID1のお店のデータを出力##コピペ時storeIDは変更すること##
try{
foreach($pdo->query('select * from information where storeID = 7') as $row){
switch($row['storetype']){
  case 1:
    echo '<img src="../../img/img-1.jpeg" class="storeimg" width=300px>';
    break;
  case 2:
    echo '<img src="../../img/img-2.jpeg" class="storeimg">';
    break;
  case 3:
    echo '<img src="../../img/img-3.jpeg" class="storeimg">';
    break;
  case 4:
    echo '<img src="../../img/img-4.jpeg" class="storeimg">';
    break;
  case 5:
    echo '<img src="../../img/img-5.jpeg" class="storeimg">';
    break;
  }
  echo "店舗名:".$row['storeName']."<br>";
  echo "住所:".$row['address']."<br>";
  echo "評価:".$row['rating']."<br>";
  echo "</a>";
  echo "</div>";
  echo "<hr>";
}
}catch(Exception $e){
  echo "エラーが発生しました。";
}
//ID1のお店のユーザー評価を出力する##コピペ時storeIDは変更すること##
echo "<div class='Evaluation'>";
try{
  foreach ($pdo->query('select * from review where storeID = "7"') as $row2) {
    // code...
    echo "<div class='userEvaluation'>";
    echo "<div class='username'>ユーザーネーム:".$row2['name']."</div>";
    echo "<div class='userrating'>評価:".$row2['rating']."</div>";
    echo "<div class='userreview'>投稿内容:".$row2['context']."</div>";
    echo "</div>";
  }
}catch(Exception $e){
  echo "エラーが発生しました。";
}
echo '</div>';
if(!empty($row2)){
  echo "<hr>";
}
?>
<!--レビュー評価の送信フォーム-->
<form action="../reviewpost.php" method="post">
  <label for="review">レビュー内容</label>
  <textarea name="review" id="review" rows="4" cols="40" value=""></textarea>
  <label for="rating">お店の評価</label>
  <select name="rating" id="rating">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  <!--コピペ時storeidのvalueは変更すること-->
  <input type="hidden" name="storeid" value="7">
  <input type="submit" value="送信">
</form>
</body>
</html>
