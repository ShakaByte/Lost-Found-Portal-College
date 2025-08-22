<?php
session_start();
include '../includes/dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    echo "user id not in session!";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_query = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();

// Check if user details are fetched successfully
if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
} else {
    echo "User details not found!";
    exit();
}

// Fetch items posted by the user
$item_query = $conn->prepare("SELECT * FROM items WHERE email = ?");
$item_query->bind_param("s", $user['email']);
$item_query->execute();
$item_result = $item_query->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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

    <div class="accout-details">
        <h2>Your Details</h2>
        <?php if (isset($user)): ?>
            <div>
                <p><strong>Username:</strong> <?= htmlspecialchars($user['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            </div>
        <?php else: ?>
            <p>Details not found</p>
        <?php endif; ?>
    </div>

    <div>
        <div class="post-card">
            <h3>Your Posts</h3>
            <?php if ($item_result && $item_result->num_rows > 0): ?>
                <div>
                    <?php while ($item = $item_result->fetch_assoc()): ?>
                        <img src="<?= htmlspecialchars($item['imgpath']) ?>" alt="<?= htmlspecialchars($item['itemname']) ?>" style="width:150px; height:150px; object-fit:cover;">
                        <h3><?= htmlspecialchars($item['itemname']) ?></h3>
                        <p><?= htmlspecialchars($item['description']) ?></p>
                        <p><strong>Category:</strong> <?= htmlspecialchars($item['category']) ?> | <strong>Type:</strong> <?= htmlspecialchars($item['type']) ?></p>
                        <p><strong>Posted on:</strong> <?= htmlspecialchars($item['posted_at']) ?> | <strong>Status:</strong> <?= htmlspecialchars($item['status']) ?></p>
                        <p><strong>Contact:</strong> <?= htmlspecialchars($item['contact']) ?> | <?= htmlspecialchars($item['email']) ?></p>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No reports found.</p>
            <?php endif; ?>
        </div>
        <?php 
        if (isset($user_query)) $user_query->close();
        if (isset($item_query)) $item_query->close();
        $conn->close();
        ?>
    </div>
    <br>
    <button><a href="../auth/logout.php">Log Out</a></button>
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
</body>
</html>