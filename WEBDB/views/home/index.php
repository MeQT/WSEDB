<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['User'])){
        header("Location: index.php?url=userpanel/index");
    }
?>
<div class ="container" >
<form action="index.php?url=studentSurveyController/startQuiz" method="Post">   
    <h3> Bitte geben Sie hier den Quiz-Code ein</h3></br>
    <div class ="form-group">
    <label for="Quiznummer">Quiznummer</label>
    <input type="text" class="form-control" name="Quiznumber" required oninvalid="this.setCustomValidity('Bitte korrekten Quizcode eingeben.')" placeholder ="Quiz-Code"/>
    </div> 
    <br>
    <input type="submit" class="btn btn-primary" value="Quiz starten"/> </br>
</form>
</div>

