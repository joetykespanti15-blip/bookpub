<?php 
session_start();
require_once 'core/dbConfig.php'; require_once 'core/models.php';
$author = getAuthorByID($pdo, $_GET['author_id']);
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <h1>Edit Author</h1>
        <form action="core/handleForms.php?author_id=<?php echo $_GET['author_id']; ?>" method="POST">
            <input type="text" name="fName" value="<?php echo $author['first_name']; ?>" required>
            <input type="text" name="lName" value="<?php echo $author['last_name']; ?>" required>
            <input type="text" name="gender" value="<?php echo $author['gender']; ?>" required>
            <input type="text" name="genre" value="<?php echo $author['genre']; ?>" required>
            <input type="email" name="email" value="<?php echo $author['email']; ?>" required>
            <input type="date" name="bdate" value="<?php echo $author['birth_date']; ?>" required>
            <input type="submit" name="editAuthorBtn" value="Update Author">
        </form>
    </div>
</body>
</html>