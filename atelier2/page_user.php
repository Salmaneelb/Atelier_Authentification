<?php 

session_start(); 

if (isset($_COOKIE['authToken'], $_SESSION['authToken']) &&
    $_COOKIE['authToken'] === $_SESSION['authToken'] ) {
    header('Location: page_admin.php');
    exit();
}

?>


<html>

  <h1> Bienvue sur la page USER</h1>
</html>
