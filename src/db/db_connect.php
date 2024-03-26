<?php

try {
    $pdo = new PDO('mysql:dbhost=thuvienne.localhost;dbname=thuvienne','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    echo "Can't connect to Database!";
    exit();
}