<?php
try {

   $host = "localhost";
   $dbname = "practice_blog";
   $username = "root";
   $pwd = "yagya";

   $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $pwd);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   echo $e->getMessage();
}
