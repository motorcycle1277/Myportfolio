<?php
session_start();

//POSTされてきた駅名をセッションの駅名配列に格納
$_SESSION['stationname'] = $_POST['stationfind'];

//index.htmlをリダイレクト
header( "Location: ../index.php" );
exit ;
