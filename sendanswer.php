<?php
session_start();
if(empty($_SESSION["login"])) {
    header("Location: login.php?err=5");
}
require_once("config.php");

$title = $_POST["title"];
$sql = "SELECT * FROM questions";
$sql .= " WHERE title= '" . $title . "'";

$rs = $pdo->query($sql);




$i = 1; while($row = $rs->fetch(PDO::FETCH_ASSOC)):

    $q_id = $row["q_id"];
    $u_id = $_SESSION["u_id"];


    $sql = "INSERT INTO answers(q_id, answer, u_id)";
    $sql .= " VALUES('$q_id', :answer, '$u_id')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":answer", $_SESSION["answer" . $i], PDO::PARAM_STR);
    $stmt->execute();



    // print_r($_SESSION["answer" . $i]);

$i++;
endwhile;

header("Location: index.php");
?>