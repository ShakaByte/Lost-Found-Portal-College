<?php
session_start();
include '../includes/dbconnect.php';
if(isset($_POST['upload'])){
    $name=$_POST['name'];
    $usn=$_POST['usn'];
    $dept=$_POST['dept'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $itemname=$_POST['itemname'];
    $category=$_POST['category'];
    $desc=$_POST['desc'];
    $addet=$_POST['addet'];
    $type='found';
    $status='unclaimed';
    
    $image=$_FILES['image']['name'];
    $imgtmp=$_FILES['image']['tmp_name'];
    $imgtype=$_FILES['image']['type'];
    $imgpath='../uploads/' . basename($image);
    $allowedtypes=['image/jpeg','image/png','image/jpg','image/webp'];
    if(!in_array($imgtype,$allowedtypes)){
        die("invalid file type");
    }
    if(!move_uploaded_file($imgtmp,$imgpath)){
        die("failed to upload image");
    }


    $stmt=$conn->prepare("select * from users where email= ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0){
        $insert=$conn->prepare("INSERT INTO `founditems`(`Name`, `USN`, `Dept`, `Contact`, `Email`,`itemname`, `category`, `Description`, `imgpath`, `addet`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $insert->bind_param("sssssssssss",$name,$usn,$dept,$contact,$email,$itemname,$category,$desc,$imgpath,$addet,$status);
        $insert->execute();
        $insertitems=$conn->prepare("INSERT INTO `items`(`type`, `usn`, `contact`, `email`, `itemname`, `category`, `description`, `imgpath`, `addet`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insertitems->bind_param("ssssssssss",$type,$usn,$contact,$email,$itemname,$category,$desc,$imgpath,$addet,$status);
        $insertitems->execute();
    echo "Found Item details submitted successfully.";
    }
    else{
        echo "Error occured.Retry, check your entries";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report For Found- R Y M E C</title>
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <div class="top-head">
        <header>
            <h2>LOST OR FOUND - R . Y . M . E . C</h2>
            <p>Loose Physically, Find Digitally</p>
        </header>
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="reportlost.php">Report Lost</a>
            <a href="reportfound.php">Report Found</a>
            <a href="profile.php">Profile</a>
        </div>
    </div>
    <div class="form-head">
        <h2>Report For The Found</h2>
    </div>
    <div class="form-container">
        <form action="reportfound.php" method="post" enctype="multipart/form-data">
            <h4>Personal Details</h4><br><br>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div><br>
            <div class="form-group">
                <label for="usn">University Number</label>
                <input type="text" name="usn" required>
            </div><br>
            <div class="form-group">
                <label for="dept">Department</label>
                <select name="dept" id="dept" required>Department
                    <option value="">--select--</option>
                    <option value="cse">CSE</option>
                    <option value="cseaiml">CSE-AIML</option>
                    <option value="cseds">CSE-DS</option>
                    <option value="eee">EEE</option>
                    <option value="ece">ECE</option>
                    <option value="mech">MECH</option>
                    <option value="civil">CIVIL</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="tel" name="contact" placeholder="+91 00000 00000" required>
            </div><br>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div><br>
            <h4>Found Item Details</h4>
            <div class="form-group">
                <label for="itemname">Item Name</label>
                <input type="text" name="itemname" required>
            </div><br>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">--select--</option>
                    <option value="documents">Documents and Papers</option>
                    <option value="books">Books and Accessories</option>
                    <option value="electronics">Electronics</option>
                    <option value="other">Others</option>
                </select>
            </div><br>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="desc" rows="4" cols="30" placeholder="Describe details about item you found like color,brand,features,etc."></textarea>
            </div><br>
            <div class="form-group">
                <label for="image">Item Preview</label>
                <input type="file" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="addet">Additional Details</label>
                <textarea name="addet" cols="30" rows="4" placeholder="Any additional details like where,when,how you found it."></textarea>
            </div><br>
            <button type="submit" name="upload">Post</button>
        </form>
    </div><br><br>
    <div>
        <hr>
        <section id="contact">
            <footer>
                <h3>About</h3>
                <p>
                    <a href="http://rymec.edu.in">Rao Bahadur Y Mahabaleswarappa Engineering College</a>
                    <address>Vijaya Nagar, Cantonment, Ballari, Karnataka 583104</address>
                    Phone No.: 083922 44809
                </p>
                <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3851.0150061584063!2d76.88891737385353!3d15.157520563201864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bb713b44d844553%3A0x226051d83214647!2sRao%20Bahadur%20Y.%20Mahabaleswarappa%20Engineering%20College!5e0!3m2!1sen!2sin!4v1746296352482!5m2!1sen!2sin" width="500" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </footer>
        </section>
    </div>
</body>
</html>