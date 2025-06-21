<?php
$page = $_GET['page'] ?? 'home';  
$file = $page . '.php';

if (file_exists($file)) {
    include $file; 
} else {
    header("HTTP/1.0 404 Not Found");
    include '404.php'; 
}
?>
