<?php 
session_start();
if(empty($_SESSION["login"])) {
    header("Location: login.php?err=6");
    exit();
}
require_once("config.php");

$sql1 = "SELECT DISTINCT title FROM questions ORDER BY due DESC";
$sql2 = "SELECT DISTINCT due FROM questions ORDER BY due DESC";
$stmt1 = $pdo->query($sql1);
$stmt2 = $pdo->query($sql2);
$stmt1->execute();
$stmt2->execute();

if(empty($_GET["title"]) && empty($_GET["due"]) && empty($_GET["quiz"])) {
    $sql3 = "SELECT * FROM questions ORDER BY due DESC";
    $stmt3 = $pdo->query($sql3);
    $stmt3->execute();
} else if(!empty($_GET["title"])) {
    $sql3 = "SELECT * FROM questions";
    $sql3 .= " WHERE title=:title";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->bindValue(":title", $_GET["title"], PDO::PARAM_STR);
    $stmt3->execute();
} else if(!empty($_GET["due"])) {
    $sql3 = "SELECT * FROM questions";
    $sql3 .= " WHERE due=:due";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->bindValue(":due", $_GET["due"], PDO::PARAM_STR);
    $stmt3->execute();
} 

/*
else if(!empty($_GET["quiz"])) {
    $sql3 = "SELECT * FROM questions";
    $sql3 .= " WHERE quiz like :quiz";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->bindValue(":quiz", "%" . $_GET["quiz"] . "%", PDO::PARAM_STR);
}
*/


?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo WEB_TITLE; ?> : Quiz list</title>
        <link rel="stylesheet" href="reset.css" >   
        <link rel="stylesheet" href="style.css" >   
    </head>
    <body>
    <header>
        <h1 id="logo"><a href="index.php"><span class="yellow">L</span>anguage <br>Bootcamp</a></h1>
        <!--
            <div class="right-block">
                <h2 id="logout"><a href="logout.php">Log out</a></h2>
            </div>
        -->
        </header>
        <div id="container">
            <div class="list-container">
                
                <form action="" method="get">
                    <h2>Quiz list</h2>
                    <p class="sort">Sort by</p>
                    
                    <select name="title" class="select-title">
                        <option value="">Title</option>
                        <?php  while($row = $stmt1->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?></option>
                        <?php  endwhile; ?>
                    </select>
                            
                    <select name="due" class="select-due">
                        <option value="">Due</option>
                        <?php  while($row = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
                            
                            <option value="<?php echo htmlspecialchars($row['due'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($row['due'], ENT_QUOTES); ?></option>
                        <?php  endwhile;  ?>
                    </select>
                    
                    <p class="search-btn">
                        <button type="submit" class="search-submit">Search</button> 
                        <a href="index.php" class="back-top back-top-list">Back</a>
                    </p>
                    <!--
                    <input type="text" name="quiz">
                    <button type="submit">Search</button>
                    -->
                    
                    
                    
                </form>


                <table class="quiz-table">
                    <tr>
                        <th class="table-title">Title</th><th class="table-due">Due</th><th class="table-quiz">quiz</th><th class="table-hint">Hint</th>
                    </tr>
                    <?php while($row = $stmt3->fetch(PDO::FETCH_ASSOC)): ?>
                    
                    <tr>
                    <td class="table-title table-element"><a href="addquiz.php?q_id=<?php echo $row['q_id']; ?>"><?php echo htmlspecialchars($row["title"], ENT_QUOTES); ?></a></td>
                       <td class="table-due table-element"><a href="addquiz.php?q_id=<?php echo $row['q_id']; ?>"><?php echo htmlspecialchars($row["due"], ENT_QUOTES); ?></a></td>
                        <td class="table-quiz table-element"><a href="addquiz.php?q_id=<?php echo $row['q_id']; ?>"><?php echo htmlspecialchars($row["quiz"], ENT_QUOTES); ?></a></td>
                        <td class="table-hint table-element"><a href="addquiz.php?q_id=<?php echo $row['q_id']; ?>"><?php echo htmlspecialchars($row["hint"], ENT_QUOTES); ?></a></td>
                        </tr>
                    
                    <?php endwhile; ?>
                </table>
            </div>
            


               








        </div>







    </body>
</html>