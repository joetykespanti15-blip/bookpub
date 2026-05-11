<?php
session_start();
require_once 'dbConfig.php';
require_once 'models.php';

$currentUser = $_SESSION['username'] ?? "System";

/* AUTH */
if (isset($_POST['registerUserBtn'])) {
    if (insertUser($pdo, $_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT))) {
        header("Location: ../login.php?success=1");
    } else {
        header("Location: ../login.php?error=UsernameExists");
    }
    exit();
}

if (isset($_POST['loginUserBtn'])) {
    $user = loginUser($pdo, $_POST['username'], $_POST['password']);
    if ($user) { $_SESSION['username'] = $user['username']; header("Location: ../index.php"); }
    else { header("Location: ../login.php?error=1"); }
    exit();
}

if (isset($_GET['logout'])) { session_destroy(); header("Location: ../login.php"); exit(); }

/* AUTHOR ACTIONS */
if (isset($_POST['insertAuthorBtn'])) {
    $sql = "INSERT INTO authors (first_name, last_name, gender, genre, email, birth_date) VALUES (?,?,?,?,?,?)";
    if ($pdo->prepare($sql)->execute([$_POST['fName'], $_POST['lName'], $_POST['gender'], $_POST['genre'], $_POST['email'], $_POST['bdate']])) {
        insertLog($pdo, "CREATE", null, $currentUser, "Added Author: " . $_POST['fName']);
        header("Location: ../index.php");
    }
    exit();
}

if (isset($_POST['editAuthorBtn'])) {
    if (updateAuthor($pdo, $_POST['fName'], $_POST['lName'], $_POST['gender'], $_POST['genre'], $_POST['email'], $_POST['bdate'], $_GET['author_id'])) {
        insertLog($pdo, "UPDATE", $_GET['author_id'], $currentUser, "Updated Author: " . $_POST['fName']);
        header("Location: ../index.php");
    }
    exit();
}

if (isset($_POST['deleteAuthorBtn'])) {
    if (deleteAuthor($pdo, $_GET['author_id'])) {
        insertLog($pdo, "DELETE", $_GET['author_id'], $currentUser, "Deleted an Author record.");
        header("Location: ../index.php");
    }
    exit();
}

/* BOOK ACTIONS */
if (isset($_POST['insertBookBtn'])) {
    if (insertBook($pdo, $_POST['bookTitle'], $_POST['isbn'], $_GET['author_id'])) {
        insertLog($pdo, "CREATE", $_GET['author_id'], $currentUser, "Added Book: " . $_POST['bookTitle']);
        header("Location: ../viewprojects.php?author_id=" . $_GET['author_id']);
    }
    exit();
}

if (isset($_POST['editBookBtn'])) {
    if (updateBook($pdo, $_POST['bookTitle'], $_POST['isbn'], $_GET['book_id'])) {
        insertLog($pdo, "UPDATE", $_GET['author_id'], $currentUser, "Updated Book: " . $_POST['bookTitle']);
        header("Location: ../viewprojects.php?author_id=" . $_GET['author_id']);
    }
    exit();
}

if (isset($_POST['deleteBookBtn'])) {
    if (deleteBook($pdo, $_GET['book_id'])) {
        insertLog($pdo, "DELETE", $_GET['author_id'], $currentUser, "Deleted a Book record.");
        header("Location: ../viewprojects.php?author_id=" . $_GET['author_id']);
    }
    exit();
}
?>