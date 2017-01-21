<?php
require_once 'models/studentsurvey.php';
require_once 'models/survey.php';
require_once 'models/questions.php';
$model = unserialize($data);
?>

<div class="container">
    <h3> Umfrage</h3>
    
    <?php 
        echo $model->Questionairy->Questionairy->Title;
        echo '<br>';
        echo $model->Questionairy->Questionairy->Description;
        
        echo '<form action="index.php?url=studentSurveyController/getNextAnswer" method="POST">';
        echo '<input type="hidden" name="quiz" value="'. base64_encode(serialize($model)).'"/>';
        echo '<input type="submit" class="btn btn-danger " value="Start"/>';
        echo '</form>';
    ?>
</div>

