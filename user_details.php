<?php
// Include your database connection code here (PDO)
include 'components/connect.php';
// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : (isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : '');
if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location: all_posts.php');
}
// Check if a valid user_id is provided in the URL
try {
    $error_message = '';
    if (!empty($user_id)) {
    // Fetch user details from the database based on user_id
        $stmt = $conn->prepare("SELECT posts.user_id, users.* FROM users INNER JOIN posts ON posts.user_id = users.user_id WHERE posts.user_id = users.user_id;");
        $stmt->execute();;
    
        if($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
        // User not found
        $error_message = 'User not found.';
        }
    } else {
    // No user_id provided in the URL
    $error_message = 'User ID not provided.';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getmessage();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <!-- Add your CSS styles here -->
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="styles.css">
   <style type="text/css">
.user-details {
    margin: 20px auto;
    padding: 20px;
    max-width: 1200px;
    background-color: #cff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.user-details h2 {
    background-color: rgba(100, 255, 100, 0.5);
    color: #000;
    padding: 10px;
    text-align: left;
    font-size: 20px;
    border-radius: 15px;
}
.details {
    margin: 10px auto;
    background-color: rgba(100, 255, 100, 0.3);
    color: #000;
    padding: 10px;
    text-align: left;
    font-size: 20px;
    border-radius: 15px;
}
</style>
</head>
<body>
    <!-- Add your navigation or header section here -->
    <!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->
    <main>
        <div class="user-details">
            <?php
            // Check if user details are available
            if(isset($user)) {
                echo '<h2>User Information</h2>';
                echo "<div class='details'>";
                echo '<p><strong>Name:</strong> ' . $user['name'] . '</p>';
                echo '<p><strong>Email:</strong> ' . $user['email'] . '</p>';
                echo '<p><strong>Phone:</strong> ' . $user['phone'] . '</p>';
                echo '<p><strong>Location:</strong> ' . $user['location'] . '</p>';
                echo "</div>";
                // You can display additional user details as needed
            } else {
                // Display an error message if user details are not available
                echo '<p>' . $error_message . '</p>';
            }
            ?>
        </div>
    </main>
   <script src="script.js"></script>

<?php include 'components/alerts.php'; ?>
</body>
</html>
