<?php
session_start();
include '../includes/dbconnect.php';

if (isset($_POST['delete_report'])) {
    $gid = $_POST['gid'];  // items.id

    // Step 1: Fetch type and email
    $stmt = $conn->prepare("SELECT type, email FROM items WHERE gid = ?");
    $stmt->bind_param("i", $gid);
    $stmt->execute();
    $stmt->bind_result($type, $email);
    $stmt->fetch();
    $stmt->close();

    if ($type && $email) {
        if ($type === "found") {
            $deleteFound = $conn->prepare("DELETE FROM founditems WHERE email = ?");
            $deleteFound->bind_param("s", $email);
            $deleteFound->execute();
        } elseif ($type === "lost") {
            $deleteLost = $conn->prepare("DELETE FROM lostitems WHERE email = ?");
            $deleteLost->bind_param("s", $email);
            $deleteLost->execute();
        }

        // Step 2: Delete from items
        $deleteItem = $conn->prepare("DELETE FROM items WHERE gid = ?");
        $deleteItem->bind_param("i", $gid);
        $deleteItem->execute();

        echo "Report deleted successfully.";
    } else {
        echo "Item not found or missing data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Reports - Admin</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        form { display: inline; }
    </style>
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <h2>Admin Panel - Report Stats</h2>

    <?php if (isset($message)) echo "<p><strong>$message</strong></p>"; ?>

    <table>
        <thead>
            <tr>
                <th>GID</th>
                <th>Type</th>
                <th>Item Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Image</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM items ORDER BY gid DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['GID']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['itemname']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><img src='".$row['imgpath']."' alt='Image' width='60'></td>";
            echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='gid' value='".$row['GID']."'>
                        <button type='submit' name='delete_report' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <button><a href="admindb.php">Back to Home</a></button>
</body>
</html>