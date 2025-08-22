<?php
session_start();
include '../includes/dbconnect.php';
$sql="SELECT * FROM users ORDER BY registered_date ASC";
$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Lost Or Found Portal - R.Y.M.E.C</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <!--header-->
    <div class="top-head">
        <header>
            <h2>LOST OR FOUND - R . Y . M . E . C</h2>
            <p>Loose Physically, Find Digitally</p>
        </header>
        <div class="navbar">
            <a href="admindb.php">Home</a>
            <a href="#usermanagement">User Management</a>
            <a href="reportstats.php">Report Status</a>
            <a href="../auth/addnewuser.php">Add New User</a>
            <button><a href="../auth/logout.php">Log Out</a></button>
        </div>
    </div>
    <!--header end-->
    <!--user management-->
    <div>
        <section id="usermanagement">
            <div class="table-head">
                <h2>Users</h2>
                <div class="table-view">
                    <table border="1" cellpadding="20" cellspacing="5">
                        <thead>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_assoc($result)){?>
                                <tr>
                                    <td><?php echo $row['user_id']?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['role'];?></td>
                                    <td><?php echo $row['registered_date'];?></td>
                                    <td><a href="deleteuser.php?id=<?php echo $row['user_id'];?>" onclick="return confirm('delete this user?')"> Delete </a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!--user management end-->
    <br><br>
    <!--footer-->
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3851.0150061584063!2d76.88891737385353!3d15.157520563201864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bb713b44d844553%3A0x226051d83214647!2sRao%20Bahadur%20Y.%20Mahabaleswarappa%20Engineering%20College!5e0!3m2!1sen!2sin!4v1746296352482!5m2!1sen!2sin" width="600" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </footer>
        </section>
    </div>
    <!--footer end-->
</body>
</html>