<?php
require_once 'models/studentsurvey.php';
require_once 'models/survey.php';
require_once 'models/questions.php';
$model = unserialize($data);
?>

<div class="container">   
    <?php 
        echo '<div class="container">';
        echo '<h3><p>'.$model->Questionairy->Questionairy->Title.'</p></h3>';
        echo '<br>';
        echo $model->Questionairy->Questionairy->Description;
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="btn-lg>';
        echo '<div class="col-sm-10">';
        echo '<div class="text-center">';
        echo '<form action="index.php?url=studentSurveyController/getNextAnswer" method="POST">';
        echo '<input type="hidden" name="quiz" value="'. base64_encode(serialize($model)).'"/>';
        echo '<input type="submit" class="btn btn-primary btn-block" value="Start"/>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    ?>
</div>

