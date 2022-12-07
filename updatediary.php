<?php
session_start();
include ("connection.php");
$diary = $_POST['diary'];
$id = $_SESSION['id'];

$query = "UPDATE users SET diary=? WHERE id=?  LIMIT 1";
$statement = mysqli_stmt_init($connection);
if(!mysqli_stmt_prepare($statement, $query)) {
    header("Location: updatediary.php?error=sqlerror"); 
    exit();
    
} else {
    mysqli_stmt_bind_param($statement, "ss", $diary, $id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    print_r($_SESSION);    
}


?>

