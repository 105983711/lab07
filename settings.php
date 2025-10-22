<?php
/**
 * Database Configuration Settings
 * AutoGallery Management System
 */

// Database connection parameters
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "exhibition_db";

// Attempt to establish database connection
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// Check connection and handle errors
if (!$conn) {
    die("<div style='padding: 25px; background: linear-gradient(45deg, #ff6b6b, #ee5a52); color: white; border-radius: 12px; margin: 30px; text-align: center; font-family: Arial, sans-serif;'>
            <h2 style='margin: 0 0 15px 0;'>🔧 Database Connection Issue</h2>
            <p style='margin: 0; font-size: 16px;'>Please check your database configuration and try again.</p>
         </div>");
}
?>