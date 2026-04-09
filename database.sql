-- Create database
CREATE DATABASE IF NOT EXISTS library_mvc;
USE library_mvc;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    isbn VARCHAR(20),
    category_id INT,
    total_copies INT NOT NULL DEFAULT 1,
    available_copies INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Transactions table
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    issue_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE DEFAULT NULL,
    status ENUM('issued', 'returned', 'overdue') DEFAULT 'issued',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Insert sample categories
INSERT INTO categories (name) VALUES
('Fiction'),
('Science'),
('History');

-- Insert sample books
INSERT INTO books (title, author, isbn, category_id, total_copies, available_copies) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 1, 5, 5),
('A Brief History of Time', 'Stephen Hawking', '9780553380163', 2, 3, 3),
('Sapiens', 'Yuval Noah Harari', '9780062316097', 3, 4, 4),
('1984', 'George Orwell', '9780451524935', 1, 2, 2),
('The Selfish Gene', 'Richard Dawkins', '9780199291151', 2, 2, 2),
('To Kill a Mockingbird', 'Harper Lee', '9780061120084', 1, 4, 4),
('The Hobbit', 'J.R.R. Tolkien', '9780547928227', 1, 3, 3),
('The Catcher in the Rye', 'J.D. Salinger', '9780316769488', 1, 3, 3),
('A Short History of Nearly Everything', 'Bill Bryson', '9780767908184', 2, 2, 2),
('The Art of War', 'Sun Tzu', '9781599869773', 3, 5, 5);

-- Insert users (passwords are hashed with password_hash())
-- admin@library.com / admin123
-- john@example.com / student123
INSERT INTO users (name, email, password, role) VALUES
('Admin User', 'admin@library.com', '$2y$10$fuKPsp7i/dKXk2P9vGCIpeS.4CHFNiNDXu6gZ43FiY95AD8pbbQIS', 'admin'),
('John Doe', 'john@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Gatmai Nyuot', 'student1@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Gattiek Nyang', 'student2@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('james Dak', 'student3@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Ruai David', 'student4@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Machar Teny', 'student5@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Gai Nhial', 'student6@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Chuol Gatmai', 'student7@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Mal Buom', 'student8@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Peter Ran', 'student9@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Nyanaath David', 'student10@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Monica Chuol', 'student11@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Teny Gal', 'student12@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Tabuom Gai', 'student13@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Narial Gai', 'student13b@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Ruot Chuol', 'student14@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('David Chuol', 'student15@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Nyaruot Gai', 'student16@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Roda Kuong', 'student17@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Tom Tong', 'student18@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('Matik chuol', 'student19@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student'),
('John Lam', 'student20@example.com', '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO', 'student');

-- Insert sample transactions
INSERT INTO transactions (user_id, book_id, issue_date, due_date, status) VALUES
(2, 1, '2025-03-01', '2025-03-15', 'issued'),
(2, 2, '2025-02-20', '2025-03-06', 'overdue'),
(2, 3, '2025-02-25', '2025-03-11', 'returned');
-- Update returned book's return_date
UPDATE transactions SET return_date = '2025-03-10', status = 'returned' WHERE id = 3;