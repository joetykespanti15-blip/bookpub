<?php 
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Manage Books</title><link rel="stylesheet" href="style.css"></head>
<body style="display: block;">
    <div class="dashboard-container">
        <a href="index.php">Back to Authors</a>
        <?php $author = getAuthorByID($pdo, $_GET['author_id']); ?>
        <h1>Books for <?php echo $author['first_name'] . " " . $author['last_name']; ?></h1>

        <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
            <h3>Add New Book</h3>
            <form action="core/handleForms.php?author_id=<?php echo $_GET['author_id']; ?>" method="POST">
                <input type="text" name="bookTitle" placeholder="Book Title" required>
                <input type="text" name="isbn" placeholder="ISBN" required>
                <input type="submit" name="insertBookBtn" value="Add Book">
            </form>
        </div>

        <table>
            <tr><th>Title</th><th>ISBN</th><th>Actions</th></tr>
            <?php 
            $books = getBooksByAuthor($pdo, $_GET['author_id']); 
            foreach ($books as $b) { ?>
            <tr>
                <td><?php echo $b['book_title']; ?></td>
                <td><?php echo $b['isbn']; ?></td>
                <td>
                    <a href="editproject.php?book_id=<?php echo $b['book_id']; ?>&author_id=<?php echo $_GET['author_id']; ?>">Edit</a> | 
                    <a href="deleteproject.php?book_id=<?php echo $b['book_id']; ?>&author_id=<?php echo $_GET['author_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>