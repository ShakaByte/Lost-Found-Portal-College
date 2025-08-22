<?php
session_start();
include '../includes/dbconnect.php';
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $passwordin=$_POST['password'];
    $stmt=$conn->prepare("SELECT * FROM users WHERE email= ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();

    /*echo "row found ".$result->num_rows;*/

    if($result->num_rows>0){
        $row=$result->fetch_assoc();

/*        echo "stored password hash:".$row['password'];*/

        if(password_verify($passwordin,$row['password'])){
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['role']=$row['role'];
            echo "session set: ".$_SESSION['user_id'];
            if($row['role']==='user'){
                header("Location:../user/home.php");
                exit();
            }elseif($row['role']==='admin'){
                header("Location:../admin/admindb.php");
                exit();
            }
        }else{
            echo "Incorrect Credentials";
        }
    }
    else{
        echo "login failed. ID or Passoword is incorrect";
    }
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found-Login: RYMEC</title>
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
</head>
<body>
    <div class="container">
        <header class="header">WELCOME TO LOST AND FOUND PORTAL - R . Y . M . E . C</header>
        <p class="sub-header">Loose Physically, Find Digitally.</p>
    </div>
    <div class="form-container">
        <div class="form-header">
            <h2>Login</h2><br>
        </div>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email ID</label><br>
                <input type="email" id="email" name="email" required><br><br>
            </div>
            <div class="form-group">
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
            </div>
            <br>
            <button type="submit" name="login" value="login">Login</button>
            <br>
            <div class="seperator"><hr></div>
            <a href="admincontact.php" class="log-btn">Create an account</a>
        </form>
    </div>
</body>
</html>