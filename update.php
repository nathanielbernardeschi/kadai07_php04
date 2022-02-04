<?php
//1. POSTデータ取得
$booktitle   = $_POST['booktitle'];
$address  = $_POST['address'];
$memo = $_POST['memo'];
$id     = $_POST['id'];

//2. sDB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_bm_table SET booktitle=:booktitle,address=:address,memo=:memo WHERE id=:id;');
$stmt->bindValue(':booktitle',   $booktitle,   PDO::PARAM_STR);
$stmt->bindValue(':address',  $address,  PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
