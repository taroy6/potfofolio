<?php 
session_start();
$token = bin2hex(random_bytes(32));
$_SESSION["token"] = $token;

require_once("config.php");
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="style.css">
        <title><?php echo WEB_TITLE; ?> : Sign up</title>
    </head>
    <body>
        <div class="root-wrapper">
            <div id="whole-wrapper">
                <header>
                <h1 id="logo"><a href="index.php"><span class="yellow">L</span>anguage <br>Bootcamp</a></h1>
                    <div class="rheader">
                        
                    </div>

                </header>
                <div id="container">
                    <div class="login-wrapper">
                        <h2 class="page-title">Sign up</h2>
                        <form action="register.php" method="post" class="login-form">
                            <label for="u_id"><p class="login-info">User ID</p></label>
                            <p class="login-input"><input type="text" name="u_id" id="u_id"></p>
                            <label for="pass"><p class="login-info">Password</p></label>
                            <p class="login-input"><input type="password" name="pass" id="pass"></p>
                            
                            <button type="submit" class="login-btn">Register</button>
                            <input type="hidden" value="<?php echo $token; ?>" name="token";>

                        </form>
                        <p class="back-login"><a href="login.php" >Back</a></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>