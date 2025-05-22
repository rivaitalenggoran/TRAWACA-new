<?php

$host = 'localhost';      
$dbname = 'trwca'; 
$username = 'root';        
$password = '';        

// buat objek PDO untuk koneksi
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set error mode ke Exception 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Tangani error 
    echo "Koneksi gagal: " . $e->getMessage();
}
