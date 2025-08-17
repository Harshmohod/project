<?php
// Database update script - run this once to add user_type column to existing database
require_once __DIR__ . '/config.php';

echo "Starting database update...\n";

try {
    // Check if user_type column exists
    $result = $mysqli->query("SHOW COLUMNS FROM account_details LIKE 'user_type'");
    if ($result->num_rows == 0) {
        // Add user_type column
        $sql = "ALTER TABLE account_details ADD COLUMN user_type ENUM('user', 'tehsildar', 'admin') NOT NULL DEFAULT 'user' AFTER Region";
        if ($mysqli->query($sql)) {
            echo "✓ Added user_type column to account_details table\n";
        } else {
            echo "✗ Error adding user_type column: " . $mysqli->error . "\n";
        }
    } else {
        echo "✓ user_type column already exists\n";
    }

    // Insert sample admin user if not exists
    $checkAdmin = $mysqli->prepare("SELECT id FROM account_details WHERE Username = 'admin' LIMIT 1");
    $checkAdmin->execute();
    $checkAdmin->store_result();
    
    if ($checkAdmin->num_rows == 0) {
        $adminPassword = password_hash('admin123', PASSWORD_BCRYPT);
        $insertAdmin = $mysqli->prepare("INSERT INTO account_details (Fullname, Username, Email, Password, phone_number, State, City, Region, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $fullname = 'System Administrator';
        $username = 'admin';
        $email = 'admin@landreg.com';
        $phone = '1234567890';
        $state = 'Maharashtra';
        $city = 'Mumbai';
        $region = 'Mumbai';
        $userType = 'admin';
        
        $insertAdmin->bind_param('sssssssss', $fullname, $username, $email, $adminPassword, $phone, $state, $city, $region, $userType);
        if ($insertAdmin->execute()) {
            echo "✓ Added sample admin user (username: admin, password: admin123)\n";
        } else {
            echo "✗ Error adding admin user: " . $insertAdmin->error . "\n";
        }
        $insertAdmin->close();
    } else {
        echo "✓ Admin user already exists\n";
    }
    $checkAdmin->close();

    // Insert sample tehsildar user if not exists
    $checkTehsildar = $mysqli->prepare("SELECT id FROM account_details WHERE Username = 'tehsildar' LIMIT 1");
    $checkTehsildar->execute();
    $checkTehsildar->store_result();
    
    if ($checkTehsildar->num_rows == 0) {
        $tehsildarPassword = password_hash('tehsildar123', PASSWORD_BCRYPT);
        $insertTehsildar = $mysqli->prepare("INSERT INTO account_details (Fullname, Username, Email, Password, phone_number, State, City, Region, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $fullname = 'Tehsildar Officer';
        $username = 'tehsildar';
        $email = 'tehsildar@landreg.com';
        $phone = '9876543210';
        $state = 'Maharashtra';
        $city = 'Pune';
        $region = 'Pune';
        $userType = 'tehsildar';
        
        $insertTehsildar->bind_param('sssssssss', $fullname, $username, $email, $tehsildarPassword, $phone, $state, $city, $region, $userType);
        if ($insertTehsildar->execute()) {
            echo "✓ Added sample tehsildar user (username: tehsildar, password: tehsildar123)\n";
        } else {
            echo "✗ Error adding tehsildar user: " . $insertTehsildar->error . "\n";
        }
        $insertTehsildar->close();
    } else {
        echo "✓ Tehsildar user already exists\n";
    }
    $checkTehsildar->close();

    echo "\nDatabase update completed successfully!\n";
    echo "\nSample login credentials:\n";
    echo "Admin - Username: admin, Password: admin123\n";
    echo "Tehsildar - Username: tehsildar, Password: tehsildar123\n";

} catch (Exception $e) {
    echo "✗ Error during database update: " . $e->getMessage() . "\n";
}

$mysqli->close();
?>
