<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Edit Book</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        <?php $book = getBookByID($pdo, $_GET['book_id']); ?>
        <form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?>&author_id=<?php echo $_GET['author_id']; ?>" method="POST">
            <input type="text" name="bookTitle" value="<?php echo $book['book_title']; ?>" required>
            <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" required>
            <input type="submit" name="editBookBtn" value="Update Book">
        </form>
        <a href="viewprojects.php?author_id=<?php echo $_GET['author_id']; ?>">Cancel</a>
    </div>
</body>
</html>