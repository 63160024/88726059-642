<?php
session_start();
if(!isset($_SESSION['loggined'])){
    header('Location: login.php');
}
require_once("Dbconfig.php");

$docnum = $_GET['doc_num'];

$sql = "SELECT *
        FROM documents
        WHERE doc_num = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $docnum);
$stmt->execute();
$result = $stmt->get_result();
if( $result->num_rows == 1){
    $row = $result->fetch_object();
    echo  $row->id;
}else{
    echo "";
}
?>