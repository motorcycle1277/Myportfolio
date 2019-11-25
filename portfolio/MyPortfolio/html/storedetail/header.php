<?php
if (isset($_SESSION['EMAIL'])) {
  echo '<ul class="headerdetail">';
  echo '<li class="headlink"><a href="../logout.php">ログアウト</a></li>';
  echo '<li class="headlink"><a href="../change.php">会員情報変更</a></li>';
  echo '<li class="headlink"><a href="../../index.php">トップページ</a></li>';
  echo '</ul>';
}else if(!isset($_SESSION['EMAIL'])){
echo '<ul class="headerdetail">';
echo '<li class="headlink"><a href="../signin.php">ログイン</a></li>';
echo '<li class="headlink"><a href="../../index.php">トップページ</a></li>';
echo '</ul>';
}
 ?>
