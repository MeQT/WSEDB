<?php
require_once 'models/studentsurvey.php';
require_once 'models/survey.php';
require_once 'models/answerModel.php';
$model = unserialize(base64_decode($data));
?>
    <script src="js/jquery.rooster.js"></script>
    <script>
        $(function() {
            $('.timer').rooster('start');
        })
    </script>
<?php   
echo '<div class="container">';
echo '<div id="timer"> <p class="timer" align="center" data-rooster-seconds='.($model->Questionairy->Questions[$model->Position]->Time).' data-rooster-onComplete="nextQuestion();"></p></div>';
echo $model->Questionairy->Questions[$model->Position]->Text;
echo '<br>';
//echo 'Beantwortungszeit: ';
//echo $model->Questionairy->Questions[$model->Position]->Time;

echo '<form action="index.php?url=studentSurveyController/getNextAnswer" method="post">';
echo '<fieldset>';
echo '<table class="table" id="answerform"/>';
$counter = 0;
// if selectiontype = single;
// if selectiontype = multi;
// if selectiontype = free;
if($model->Questionairy->Questions[$model->Position]->SelectionType == 0){
    foreach ($model->Answers[$model->Position] as $value) {
        echo '<tr><td>';
        echo $value->Text;
        echo '</td><td>';
        echo '<input id="'.$value->AnswerID.'" name="Answer'.$counter++.'" type="checkbox"/>';
        echo '</td></tr>';
    }
}
if($model->Questionairy->Questions[$model->Position]->SelectionType == 1){
    foreach ($model->Answers[$model->Position] as $value) {
        echo '<tr><td>';
        echo $value->Text;
        echo '</td><td>';
        echo '<input type="radio" id="'.$value->AnswerID.'" name="Answer[]">';
        echo '</td></tr>';
    }
}
if($model->Questionairy->Questions[$model->Position]->SelectionType == 2){
    echo '<tr><td>';
    echo '<textarea rows="5" name="freetext">
        
    </textarea>';
    echo '</td></tr>';
}
echo '</table>';
echo '</fieldset>';

echo '<input type="submit" class="btn btn-primary" />';
echo '</form>';
echo '</div>';
?>
