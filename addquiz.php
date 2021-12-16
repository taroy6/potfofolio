<?php
require_once("config.php");
$sql = "SELECT DISTINCT title FROM questions";
$sql .= " ORDER BY due DESC";
$rs = $pdo->query($sql);



if(empty($_GET["q_id"])) {
    $title = "";
    $due = "";
    $hint = "";
    $quiz = "";
} else {
    $sql = "SELECT * FROM questions";
    $sql .= " WHERE q_id=:q_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":q_id", $_GET["q_id"], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = htmlspecialchars($row["title"], ENT_QUOTES);
    $due = htmlspecialchars($row["due"], ENT_QUOTES);
    $quiz = htmlspecialchars($row["quiz"], ENT_QUOTES);
    $hint = htmlspecialchars($row["hint"], ENT_QUOTES);
}



?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo WEB_TITLE; ?> : Add quiz</title>
        <link rel="stylesheet" href="style.css">
        
    </head>
    <body>
        <header>
        <h1 id="logo"><a href="index.php"><span class="yellow">L</span>anguage <br>Bootcamp</a></h1>

        </header>
            <div id="container" class="container-sp-addquiz">
                <form action="addquiz2.php" method="post" class="addquiz-form">
                    <p><label for="due">Due</label></p>
                    <p><input type="date" name="due" id="due" value="<?php echo htmlspecialchars($_SESSION["due"], ENT_QUOTES); ?>"></p>
                    <p><label for="title">Title</label></p>
                    
                    <p><select name="title" id="title" ></p>
                            <option value="" >Select a title</option>
                                <?php  while($row = $rs->fetch(PDO::FETCH_ASSOC)): 
                                                             /*       if($_GET["q_id"] == $row["q_id"]):
                                                                        $selected = "selected";
                                                                    else:
                                                                        $selected = "";
                                                                    endif;                                <?php echo $selected ; ?>   */
                                ?>
                            <option value="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>"    ><?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?></option> 
                                <?php endwhile;  ?>
                        </select>
                        
                    <div class="quiz-wrapper">
                        <div class="quiz-wrapper2">
                        <div class="template1">
                            <p><label for="quiz">Quiz</label></p>
                            <input type="text" name="quiz" id="quiz" class="input-quiz" value="<?php echo $quiz; ?>">
                        </div>
                        <div class="template2">
                            <p><label for="hint">Hint</label></p>
                            <input type="text" name="hint" id="hint" class="input-quiz" value="<?php echo $hint ?>">
                        </div>
                        </div>
                    
                    </div>    
                    <div class="clone-quiz-wrapper"></div>
                    
                    <!--<input type="button" class="clone-btn" value="Add more quiz"><br> -->
                    <button type="submit" class="submit-btn">Submit</button>



           

                </form>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="script.js"></script>
    </body>
</html>