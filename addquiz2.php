<?php
require_once("config.php");
if(empty($_POST["quiz"]) || empty($_POST["due"])) {
    header("Location: addquiz.php?err=1");
    exit();
}

$sql = "INSERT INTO questions(quiz, hint, due, title)";
$sql .= " VALUES(:quiz, :hint, :due, :title)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":quiz", $_POST["quiz"], PDO::PARAM_STR);
$stmt->bindValue(":hint", $_POST["hint"], PDO::PARAM_STR);
$stmt->bindValue(":due", $_POST["due"], PDO::PARAM_STR);
$stmt->bindValue(":title", $_POST["title"], PDO::PARAM_STR);
$stmt->execute();

$_SESSION["due"] = htmlspecialchars($_POST["due"], ENT_QUOTES);
$_SESSION["title"] = htmlspecialchars($_POST["title"], ENT_QUOTES);
 header("Location: addquiz.php");

?>