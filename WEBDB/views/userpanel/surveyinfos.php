<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
?>
<?php
    require_once 'models/surveyModel.php';
    require_once 'models/survey.php';
    require_once 'models/questionaryModel.php';
    require_once 'models/questionairy.php';
    
    $model = unserialize($data);  
?>
    <script src="js/jquery.rooster.js"></script>
    <script>
        $(function() {
            $('.timer').rooster('start');
        })
    </script>
    <div class ="container">
    <div class="" align="center" id="Code">
    <?php  
        echo '<div id="timer"> <p class="timer" data-rooster-seconds='.(($model->Time)*60).' data-rooster-onComplete="addButton();"></p></div>'; 
        echo '<div id="startCode"><br><h1>'.$model->StartCode.'</h1></div>';
        echo '<br><br><div id="link">http://projekt.wi.fh-flensburg.de/~projekt2016a/ </div>'; 
        ?>
        <form action="index.php?url=result/getResults" method="POST" id="surveyForm">
            <?php echo '<input type="hidden" name="surveyID" value="'.$model->SurveyID.'"/>';?>
            <br>
            <br>
            <input type="submit" value="Ergebnisse vorzeitig anzeigen" id="alternative" class="btn btn-primary"/>
        </form>
    </div>
        </div>
        


