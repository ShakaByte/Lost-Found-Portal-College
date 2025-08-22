<?php
session_start();
$showAlert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../includes/dbconnect.php';
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cfmpassword=$_POST['cfm_password'];
    $role=$_POST['role'];
    $stmt=$conn->prepare("select password from users where email= ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->store_result();
    if($stmt->num_rows==0){
        if($password==$cfmpassword){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $stmt->close();
            $stmt=$conn->prepare("insert into users(name,email,password,role)values(?,?,?,?)");
            $stmt->bind_param("ssss",$name,$email,$hash,$role);
            if($stmt->execute()){
                $showAlert=true;
                echo "User created successfully";
            }
        }else{
            $showerror="passwords do not match";
        }
    }else{
        $showerror="An account already exists with this email.";
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
    <title>Lost And Found Sign Up- RYMEC</title>
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <header class="header">WELCOME TO LOST AND FOUND PORTAL - R . Y . M . E . C</header>
        <p class="sub-header">Loose Physically, Find Digitally.</p>
    </div>
    <div class="form-container">
        <div class="form-header">
            <h2>Create User</h2>
        </div>
        <form action="addnewuser.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div class="form-group">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <div class="form-group">
                <label for="cfm_password">Confirm Password:</label><br>
                <input type="password" id="cfm_password" name="cfm_password" required>
            </div>
            <br>
            <div class="form-group">
                <label for="role">Role:</label><br>
                <input type="text" id="role" name="role" required>
            </div>
            <br>
            <button type="submit">Create User</button>
        </form>
    </div>
</body>
</html>