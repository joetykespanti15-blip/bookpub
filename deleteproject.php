<?php 
session_start();
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html>
<head><title>Delete Book</title><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <?php $book = getBookByID($pdo, $_GET['book_id']); ?>
        <h1>Delete Book: <?php echo $book['book_title']; ?>?</h1>
        <form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?>&author_id=<?php echo $_GET['author_id']; ?>" method="POST">
            <input type="submit" name="deleteBookBtn" value="Confirm Delete">
        </form>
        <a href="viewprojects.php?author_id=<?php echo $_GET['author_id']; ?>">Cancel</a>
    </div>
</body>
</html>