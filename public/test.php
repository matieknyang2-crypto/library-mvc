<?php
// Test database connection
require_once '../app/config/database.php';

echo "<h2>System Configuration Test</h2>";

// Test database
echo "<h3>Database Connection</h3>";
$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "<p style='color: green;'>✓ Database connection successful</p>";
    
    // Test queries
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>✓ Users in database: " . $result['count'] . "</p>";
        
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM books");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>✓ Books in database: " . $result['count'] . "</p>";
        
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM categories");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>✓ Categories in database: " . $result['count'] . "</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>✗ Database connection failed</p>";
}

echo "<h3>Test Credentials</h3>";
echo "<p><strong>Admin Login:</strong><br>";
echo "Email: admin@library.com<br>";
echo "Password: admin123</p>";

echo "<p><strong>Student Login:</strong><br>";
echo "Email: john@example.com<br>";
echo "Password: student123</p>";

echo "<p><a href='/library_mvc/public/index.php?url=auth/login'>Go to Login Page</a></p>";
?>
