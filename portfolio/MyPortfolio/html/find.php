<?php
//データベースへ接続
try{
  $pdo = new PDO(DSN,DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
  echo $e->getMessage().PHP_EOL;
}
//駅名のセッションを変数にいれる
$station = $_SESSION['stationname'];
//検索値をDBと照らし合わせて結果を出力
foreach ($pdo->query("select * from information where station = '{$station}'") as $row) {
  echo "<div class='stores'>";
  echo "<a href='html/storedetail/storedetail".$row['storeID'].".php'>";
  switch($row['storetype']){
    case 1:
      echo '<img src="../img/img-1.jpeg" class="storeimg">';
      break;
    case 2:
      echo '<img src="../img/img-2.jpeg" class="storeimg">';
      break;
    case 3:
      echo '<img src="../img/img-3.jpeg" class="storeimg">';
      break;
    case 4:
      echo '<img src="../img/img-4.jpeg" class="storeimg">';
      break;
    case 5:
    echo '<img src="../img/img-5.jpeg" class="storeimg">';
    break;
  }
  echo "店舗名:".$row['storeName']."<br>";
  echo "住所:".$row['address']."<br>";
  echo "評価:".$row['rating']."<br>";
  echo "</a>";
  echo "</div>";
}
