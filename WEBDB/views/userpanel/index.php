<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['User'])){
    ("Location: index.php?url=userpanel/questions");
}
?>