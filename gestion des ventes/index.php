<?php
    session_start();
    if(isset($_SESSION['login'])){
        header('location:produits.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales management</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<style>
    body{
	background: #2962FF;
	font-family: Arial, Helvetica, sans-serif; 
	}
    a{
    text-decoration: none !important;
    }
</style>
<body>

    <div class="container d-flex justify-content-center">
        <div class="card mx-5 my-5">
            <div class="card-body py-2 px-2">
                <h2 class="card-heading py-3 px-5">Log In</h2>
                <form action="" method="POST">
                    <div class="row rone mx-3 my-3">
                        <div class="col-md-6">
                            <div class="form-group"><label for="login" class="sr-only">Login</label><input type="text" name="login" class="form-control" id="login" placeholder="Login" required></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="inputPassword" class="sr-only">Password</label><input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required></div>
                        </div>
                    </div>
                    <div class="row rtwo mx-3">
                        <div class="col-md-6">
                            <div class="form-group"><input type="submit" value="log In" name="connexion" class="btn btn-primary mb-2"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><a href="#" class="forgot">Forgot your Password?</a></div>
                        </div>			
                    </div>
                </form>
                <?php
                    require_once("conn.php");
                    if(isset($_POST['connexion'])){
                        $login = $_POST['login'];
                        $password = $_POST['password'];
                        $sql = "SELECT * FROM utilisateur";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)){
                            if($row[0] == $login && $row[1] == $password){
                                header("location:produits.php");
                                $_SESSION['login'] = [$login, $password, $row[2]];
                            }
                        }
                        echo "The password or login is incorrect!";
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/script.js"></script>
</body>
</html>
