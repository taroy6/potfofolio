<?php 

session_start();
if(empty($_SESSION["login"])) {
    header("Location: login.php?err=5");
    exit();
    
}

require_once("config.php");
$sql = "SELECT * FROM questions";
$sql .= " WHERE title=:title";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":title", $_GET["title"], PDO::PARAM_STR);
$stmt->execute();

// $row = $stmt->fetch(PDO::FETCH_ASSOC);






// $rs = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="style.css">
        <title><?php echo WEB_TITLE; ?> : <?php echo htmlspecialchars($_GET["title"], ENT_QUOTES); ?></title>
    </head>
    <body>
        <header>
        <h1 id="logo"><a href="index.php"><span class="yellow">L</span>anguage <br>Bootcamp</a></h1>
            <div class="right-block">
                <h2 id="logout" class="logout-sp-single"><a href="logout.php">Log out</a></h2>
            </div>

        </header>
        <div id="container" class="container-sp-single">
            <h2 class="page-title"><?php echo htmlspecialchars($_GET["title"], ENT_QUOTES); ?></h2>
            <form action="confirmsubmit.php" method="post" class="quizform">
                <?php $i = 1; while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="question_set">
                    <label for="answer<?php echo $i; ?>"><p class="question"><?php echo $i; ?>.  <?php echo $row["quiz"]; ?></p></label>
                    <?php if(empty($row["hint"]) != true): ?>
                        <div class="hintbutton">Hint</div>
                        <div class="hint"><?php echo $row["hint"] ?></div>
                    <?php endif; ?>
                    <p><input class="answer" type="text" name="answer<?php echo $i; ?>" id="answer<?php echo $i; ?>"></p><br>
                    <?php $i++; ?> 

                </div>
                
                <?php endwhile; ?>
                <input type="hidden" name="title" value="<?php echo $_GET['title']; ?>">
                <button class="quiz-submit-btn"type="submit">Submit</button>
            </form>   
            
            <a href="index.php" class="back-top" onclick="return confirm('Are you sure?');">Back</a>

        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>