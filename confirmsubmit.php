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

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="style.css">
        <title><?php echo WEB_TITLE; ?> : Confirmation</title>
    </head>
    <body>
        <header>
        <h1 id="logo"><a href="index.php"><span class="yellow">L</span>anguage <br>Bootcamp</a></h1>
            <div class="rheader">
                <h2 id="logout" class="logout-confirmsubmit"><a href="logout.php">Log out</a></h2>
            </div>

        </header>
        <div id="container-confirm">
            <h2 class="page-title">Skill test</h2>
            <h4>Please check and press confirmation button</h4>
            <form action="sendanswer.php" method="post">
                <?php $i = 1; while($row = $rs->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php $_SESSION["answer" . $i] = $_POST["answer" . $i] ?>
                    <div class="question_set">
                        <p class="question"><?php echo $i; ?>.  <?php echo $row["quiz"]; ?></p>
                        <p class="display-answer"><?php echo htmlspecialchars($_POST["answer" . $i], ENT_QUOTES); ?></p>
                        
                        <?php $i++; ?> 
                    </div>
                <?php endwhile; ?>

                
                <input type="hidden" name="title" value="<?php echo $title; ?>">
                <button type="submit" class="confirm-submission">Confirm</button><br>
                <p class="back-btn"><a href="javascript:history.back();">Back</a></p>
            </form>
            
            

        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>