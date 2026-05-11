CREATE TABLE authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    gender VARCHAR(50),
    genre_specialization VARCHAR(100),
    email VARCHAR(100),
    birth_date DATE,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_title VARCHAR(200),
    isbn VARCHAR(50),
    author_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
