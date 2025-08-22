<?php
session_start();
include '../includes/dbconnect.php';

// Handle user deletion
if (isset($_POST['delete_user'])) {
    $email = $_POST['email'];

    // Delete user reports first
    $delItems = $conn->prepare("DELETE FROM items WHERE email = ?");
    $delItems->bind_param("s", $email);
    $delItems->execute();

    $delLost = $conn->prepare("DELETE FROM lostitems WHERE Email = ?");
    $delLost->bind_param("s", $email);
    $delLost->execute();

    $delFound = $conn->prepare("DELETE FROM founditems WHERE Email = ?");
    $delFound->bind_param("s", $email);
    $delFound->execute();

    // Delete user account
    $delUser = $conn->prepare("DELETE FROM users WHERE email = ?");
    $delUser->bind_param("s", $email);
    $delUser->execute();

    $message = "User and all related data deleted successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Users - Admin</title>
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <h2>Admin Panel - Delete Users</h2>
    <?php if (isset($message)) echo "<p><strong>$message</strong></p>"; ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM users ORDER BY user_id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='email' value='".$row['email']."'>
                        <button type='submit' name='delete_user' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</button>
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