<?php
require '../config/config.php';

if (isset($_GET['del_id'])) {
   $id = $_GET['del_id'];

   $delete=$conn->query("DELETE FROM posts WHERE id = '$id'");
   $delete->execute();
   header("location: http://localhost/ya/php/blog/");
}
