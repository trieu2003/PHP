<?php
$servername = "localhost";
$username = "id21952697_lantrieunam";
$password = "123123Trieu$";
$dbname = "id21952697_quanlydiemsinhvien";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
