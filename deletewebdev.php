<?php 
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Author</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php $author = getAuthorByID($pdo, $_GET['author_id']); ?>
        <h1 style="color: #d93025;">Delete Author?</h1>
        <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; text-align: left; margin-bottom: 20px;">
            <p><strong>First Name:</strong> <?php echo $author['first_name']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $author['last_name']; ?></p>
            <p><strong>Genre:</strong> <?php echo $author['genre']; ?></p>
        </div>

        <form action="core/handleForms.php?author_id=<?php echo $_GET['author_id']; ?>" method="POST">
            <input type="submit" name="deleteAuthorBtn" value="Confirm Delete" style="background-color: #d93025;">
        </form>
        <p><a href="index.php">Cancel and Go Back</a></p>
    </div>
</body>
</html>