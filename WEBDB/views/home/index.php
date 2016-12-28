<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['User'])){
        header("Location: index.php?url=userpanel/index");
    }
?>
<div class = container >
<form action="index.php" method="Post">   
    <h2> Bitte Quiz-Code eingeben </h2></br>
    <div class ="form-group">
    <label for="Quiznummer">Quiznummer</label>
    <input type="text" class="form-control" name="Quiznummer" placeholder =" Quiznummer"
    </div> 
    <br>
    <input type="submit" class="btn btn-primary" value="Quiz starten"> </br>
    </div>
</form>
</div>

