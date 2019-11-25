<?php
ini_set('display_errors', 1);
session_start();
require_once('config.php');
//データベースへ接続
try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
  echo $e->getMessage().PHP_EOL;
}
//セッションの値でデータベースのuserIDを検索
try{
    $emails = $_SESSION['EMAIL'];
    $sql = ("select * from user where email = '{$emails}'");
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
      $userID = $row['id'];
      $name = $row['name'];
    }
}catch(Exception $e){
  echo "エラーです。";
}
//データベースにPOSTされた値をinsert
try{
  $stmt = $pdo->prepare("insert into review(storeID,context,userID,name,rating) value(?,?,?,?,?)");
  $stmt->execute([$_REQUEST['storeid'],$_REQUEST['review'],$userID,$name,$_REQUEST['rating']]);
  echo "送信しました。<br>";
  echo "<a href='../index.php'>トップに戻る</a>";
}catch(Exception $e){
  echo "値が違います。";
}
//レビュー評価の平均値をinsert
try{
  //storeIDの値を全て取得し、平均値を求める
  $storeID = $_REQUEST['storeid'];
  $sql = ("select rating from review where storeID = '{$storeID}'");
  $secondrow = $pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
  $total = 0;
  foreach($secondrow as $results){
    $total += $results;
  }
  $avarage = round($total/count($secondrow));
  $newavarage = (string)$avarage;
  //求めた平均値を店舗情報の評価にupdate
  $sql = null;
  $sql = ("update information set rating = '{$newavarage}' where storeID = '{$storeID}'");
  $res = $pdo->query($sql);
}catch(PDOException $e){
  echo $e->getMessage();
  die();
}
