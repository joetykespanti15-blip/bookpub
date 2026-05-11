<?php 
require_once 'dbConfig.php';

/* USER MGMT */
function insertUser($pdo, $username, $password) {
    $check = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $check->execute([$username]);
    if ($check->rowCount() == 0) {
        return $pdo->prepare("INSERT INTO users (username, password) VALUES (?,?)")->execute([$username, $password]);
    }
    return false;
}

function loginUser($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) return $user;
    }
    return false;
}

/* LOGS */
function insertLog($pdo, $operation, $author_id, $username, $description) {
    $sql = "INSERT INTO activity_logs (operation, author_id, done_by, description) VALUES(?,?,?,?)";
    return $pdo->prepare($sql)->execute([$operation, $author_id, $username, $description]);
}

function getAllLogs($pdo) {
    return $pdo->query("SELECT * FROM activity_logs ORDER BY date_added DESC")->fetchAll();
}

/* AUTHORS */
function getAllAuthors($pdo) {
    return $pdo->query("SELECT * FROM authors ORDER BY date_added DESC")->fetchAll();
}

function getAuthorByID($pdo, $author_id) {
    $stmt = $pdo->prepare("SELECT * FROM authors WHERE author_id = ?");
    $stmt->execute([$author_id]);
    return $stmt->fetch();
}

function searchAuthors($pdo, $search) {
    $stmt = $pdo->prepare("SELECT * FROM authors WHERE first_name LIKE ? OR last_name LIKE ? OR genre LIKE ?");
    $q = "%".$search."%"; $stmt->execute([$q, $q, $q]);
    return $stmt->fetchAll();
}

function updateAuthor($pdo, $f, $l, $gen, $genre, $e, $b, $id) {
    $sql = "UPDATE authors SET first_name=?, last_name=?, gender=?, genre=?, email=?, birth_date=? WHERE author_id=?";
    return $pdo->prepare($sql)->execute([$f, $l, $gen, $genre, $e, $b, $id]);
}

function deleteAuthor($pdo, $id) {
    return $pdo->prepare("DELETE FROM authors WHERE author_id = ?")->execute([$id]);
}

/* BOOKS */
function getBooksByAuthor($pdo, $author_id) {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE author_id = ?");
    $stmt->execute([$author_id]);
    return $stmt->fetchAll();
}

function getBookByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE book_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertBook($pdo, $t, $i, $a) {
    return $pdo->prepare("INSERT INTO books (book_title, isbn, author_id) VALUES (?,?,?)")->execute([$t, $i, $a]);
}

function updateBook($pdo, $t, $i, $id) {
    return $pdo->prepare("UPDATE books SET book_title=?, isbn=? WHERE book_id=?")->execute([$t, $i, $id]);
}

function deleteBook($pdo, $id) {
    return $pdo->prepare("DELETE FROM books WHERE book_id = ?")->execute([$id]);
}
?>