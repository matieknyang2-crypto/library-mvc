<?php
// seed_students.php
// Run this once to add sample student users (for demonstration/testing)

require_once __DIR__ . '/app/config/database.php';

$students = [
    ['name' => 'Student One', 'email' => 'student1@example.com'],
    ['name' => 'Student Two', 'email' => 'student2@example.com'],
    ['name' => 'Student Three', 'email' => 'student3@example.com'],
    ['name' => 'Student Four', 'email' => 'student4@example.com'],
    ['name' => 'Student Five', 'email' => 'student5@example.com'],
    ['name' => 'Student Six', 'email' => 'student6@example.com'],
    ['name' => 'Student Seven', 'email' => 'student7@example.com'],
    ['name' => 'Student Eight', 'email' => 'student8@example.com'],
    ['name' => 'Student Nine', 'email' => 'student9@example.com'],
    ['name' => 'Student Ten', 'email' => 'student10@example.com'],
    ['name' => 'Student Eleven', 'email' => 'student11@example.com'],
    ['name' => 'Student Twelve', 'email' => 'student12@example.com'],
    ['name' => 'Student Thirteen', 'email' => 'student13@example.com'],
    ['name' => 'Student Fourteen', 'email' => 'student14@example.com'],
    ['name' => 'Student Fifteen', 'email' => 'student15@example.com'],
    ['name' => 'Student Sixteen', 'email' => 'student16@example.com'],
    ['name' => 'Student Seventeen', 'email' => 'student17@example.com'],
    ['name' => 'Student Eighteen', 'email' => 'student18@example.com'],
];

$database = new Database();
$db = $database->getConnection();

// Use the same password as the sample student (student123)
$hashedPassword = '$2y$10$XTAhwBe4BxuZJFthQIxQseW1lM0hk/mnjOignulfvm3vUDd2peqvO';

$inserted = 0;
foreach ($students as $student) {
    $stmt = $db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $student['email']]);
    if ($stmt->fetch()) {
        continue;
    }

    $stmt = $db->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, "student")');
    $stmt->execute([
        ':name' => $student['name'],
        ':email' => $student['email'],
        ':password' => $hashedPassword,
    ]);
    $inserted++;
}

header('Content-Type: text/plain');
echo "Inserted $inserted sample students.\n";
if ($inserted === 0) {
    echo "(All sample student emails already exist in the database.)\n";
}
