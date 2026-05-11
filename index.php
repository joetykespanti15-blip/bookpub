<?php 
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
require_once 'core/dbConfig.php'; require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Authors</title><link rel="stylesheet" href="style.css"></head>
<body style="display:block;">
    <div class="dashboard-container">
        <p>User: <b><?php echo $_SESSION['username']; ?></b> | <a href="core/handleForms.php?logout=1">Logout</a> | <a href="activitylogs.php">Logs</a></p>
        <h1>Author Registry</h1>
        <form action="core/handleForms.php" method="POST">
            <input type="text" name="fName" placeholder="First Name" required>
            <input type="text" name="lName" placeholder="Last Name" required>
            <input type="text" name="gender" placeholder="Gender" required>
            <input type="text" name="genre" placeholder="Genre" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="bdate" required>
            <input type="submit" name="insertAuthorBtn" value="Register Author">
        </form>
        <hr>
        <form action="index.php" method="GET"><input type="text" name="searchQuery" placeholder="Search..."><input type="submit" value="Search"></form>
        <table>
            <tr><th>Name</th><th>Genre</th><th>Actions</th></tr>
            <?php 
            $authors = isset($_GET['searchQuery']) ? searchAuthors($pdo, $_GET['searchQuery']) : getAllAuthors($pdo);
            foreach ($authors as $row) { ?>
            <tr>
                <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                <td><?php echo $row['genre']; ?></td>
                <td>
                    <a href="viewprojects.php?author_id=<?php echo $row['author_id']; ?>">Books</a> | 
                    <a href="editwebdev.php?author_id=<?php echo $row['author_id']; ?>">Edit</a> | 
                    <a href="deletewebdev.php?author_id=<?php echo $row['author_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>