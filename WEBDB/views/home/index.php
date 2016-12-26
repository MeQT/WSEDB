<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['User'])){
        header("Location: index.php?url=userpanel/index");
    }
?>
<form action="index.php" method="Post">
    <h2> Bitte Quiz-Code eingeben </h2></br>
    <input type="text" class=""></br>
    <input type="submit" class="btn btn-primary" value="Quiz starten!"> </br>
</form>

