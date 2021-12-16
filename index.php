<?php 
session_start();
if(empty($_SESSION["login"])) {
    header("Location: login.php?err=5");
    exit();
    
}

require_once(dirname(__FILE__) . "/config.php");
$sql = "SELECT DISTINCT questions.title,due FROM questions";
$sql .= " ORDER BY due DESC";
$rs = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="style.css">
        <title><?php echo WEB_TITLE; ?></title>
    </head>
    <body>
        <div id="whole-wrapper" class="whole-wrapper-sp-index">
            <header>
            <h1 id="logo"><a href="index.php"><span class="yellow">L</span>anguage <br>Bootcamp</a></h1>
                

            </header>
            
            <div id="top-container">
                <!-- <img src="img/top_background.jpg" alt="" class="backgorund">  -->
                    <p class="index-list">Quizes</p>
                    <ul class="list">
                    <?php $i = 0; while($row = $rs->fetch(PDO::FETCH_ASSOC)): ?>
                        <li><a href="single.php?title=<?php echo $row['title']; ?>">    <?php echo $row["title"]; ?></a></li>
                    <?php endwhile; ?>
                        
                    </ul>
                <p class="addquiz"><a href="addquiz.php" >Addquiz</a></p>
                <p class="quizlist"><a href="quizlist.php">Quizlist</a></p>
                <h2 id="logout" class="logout-sp-index"><a href="logout.php">Log out</a></h2>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>