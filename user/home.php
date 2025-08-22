<?php
session_start();
include '../includes/dbconnect.php';
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$type = $_GET['type'] ?? '';

$sql = "SELECT * FROM items WHERE status = 'Unclaimed'";

if (!empty($type)) {
    $type = $conn->real_escape_string($type);
    $sql .= " AND type = '$type'";
}

$sql .= " ORDER BY posted_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost Or Found- RYMEC</title>
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
    <br><br>
    <form method="get" action="">
        <select name="type">
            <option value="">All Types</option>
            <option value="lost">Lost</option>
            <option value="found">Found</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <div class="post">
        <h2>Current Lost/Found Items</h2>
        <?php if ($result && $result->num_rows > 0): ?>
        <div class="post-container">
            <?php while ($report = $result->fetch_assoc()): ?>
            <div class="post-card">
                <img src="<?= htmlspecialchars($report['imgpath']) ?>" alt="<?= htmlspecialchars($report['itemname']) ?>" style="width:150px; height:150px; object-fit:cover;">
                <h3><?= htmlspecialchars($report['itemname']) ?></h3>
            <p><?= htmlspecialchars($report['description']) ?></p>
            <p><strong>Category:</strong> <?= $report['category'] ?> | <strong>Type:</strong> <?= $report['type'] ?></p>
            <p><strong>Posted on:</strong> <?= $report['posted_at'] ?> <strong>Type:</strong><?= $report['status'] ?></p>
            <p><strong>Contact:</strong> <?= $report['contact'] ?> | <?= $report['email'] ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <p>No reports found matching your filters.</p>
        <?php endif; ?>
    </div>
    <br><br>
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