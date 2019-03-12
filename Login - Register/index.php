<?php 
    //connect with database
    $connect = mysqli_connect("localhost","root","", "testing");
    session_start();

    if(isset($_SESSION["username"])) {
        header("location:entry.php");
    }

    if(isset($_POST['register'])) {
        if(empty($_POST['username']) && empty($_POST['password'])) {
            echo '<script> alert("Both fields are required")</script>';
        }
        else {
            $username = mysqli_real_escape_string($connect, $_POST['username']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);
            //get encryption with md5
            $password = md5($password);
            $query = "INSERT INTO users(username, password) VALUES('$username', '$password')";
            if(mysqli_query($connect, $query)) {
                echo '<script>alert("Registration Done!")</script>';
            }
        }
    }

    if(isset($_POST['login'])) {
        if(empty($_POST['username']) && empty($_POST['password'])) {
            echo '<script> alert("Both fields are required")</script>';
        }
        else {
            $username = mysqli_real_escape_string($connect, $_POST['username']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);
            $password = md5($password); 
            $query = "SELECT * FROM users where username = '$username' and password = '$password'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) > 0) {
                $_SESSION['username'] = $username;
                header("location:entry.php");
            }
            else {
                echo '<script>alert("Wrong User Details")</script>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php Login - Register</title>
    <!-- CDN's -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body style="background-color:bisque;box-sizing=border-box">
    <br><br>
    <div class="container jumbotron" style="width:500px;">
        <h3 align="center">PHP Login Registration Form</h3>
        <br>
        <?php
            if(isset($_GET['action']) == "login") {
        ?>
        <h3 align="center">Login</h3>
        <br>
        <form method="POST">
            <label>Enter Username</label>
            <input type="text" name="username" class="form-control">
            <br>
            <label>Enter Password</label>
            <input type="password" name="password" class="form-control"> 
            <br>
            <center>
                <input type="submit" name="login" value="Login" class="btn btn-info">
            </center>
            <br>
            <p align="center"><a href="index.php">Register</a></p>
        </form>
        <?php
            }
            else {
            ?>
                <h3 align="center">Register</h3>
                <br>
                <form method="POST">
                    <label>Enter Username</label>
                    <input type="text" name="username" class="form-control">
                    <br>
                    <label>Enter Password</label>
                    <input type="password" name="password" class="form-control">
                    <br>
                    <center>
                        <input type="submit" name="register" value="Register" class="btn btn-dark">
                    </center>
                    <br>
                    <p align="center"><a href="index.php?action=login">Login</a></p>
                </form>
            <?php
            }
         ?>
    </div>
</body>
</html>