<?php
if (isset($_SESSION['EMAIL'])) {
  echo '<li class="headlink"><a href="html/logout.php">ログアウト</a></li>';
  echo '<li class="headlink"><a href="html/change.php">会員情報変更</a></li>';
  echo '<li class="headlink"><a href="../index.php">トップページ</a></li>';
}else if(!isset($_SESSION['EMAIL'])){
echo '<li class="headlink"><a href="html/signin.php">ログイン</a></li>';
echo '<li class="headlink"><a href="../index.php">トップページ</a></li>';
}
 ?>
