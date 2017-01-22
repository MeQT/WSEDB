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
require_once 'models/survey.php';
require_once 'models/questionairy.php';
$model = unserialize($data);
?>
<div class="container">
    <?php if(count($model)> 0){
        
    
    echo '<h3>Ihre Umfrageübersicht</h3></br> 
    <table class="table">
        <th>
            Fragebogen
        </th>
        <th>
            Start
        </th>
        <th>
            Ende
        </th>
        <th>
            Teilnehmer
        </th>
        <th>
            Aktion
        </th>'; 
        foreach ($model as $entry) {
            echo '<tr>';
            echo '<td>';
            echo $entry['Questionairy']->Title;
            echo '</td>';
            echo '<td>';
            echo $entry['Survey']['TimeStart'];
            echo '</td>';
            echo '<td>';
            echo $entry['Survey']['TimeEnd'];
            echo '</td>';
            echo '<td>';
            echo $entry['Attendence'];
            echo '</td>';
            echo '<td>';
            echo '<form action="index.php?url=resultShowResult" method="POST">';
            echo '<input type="hidden" value="'.$entry['Survey']['SurveyID'].'" name="survey_id"/>';
            echo '<input type="submit" value="ansehen"/>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    }
    else{
        echo '<br>Sie haben bisher keine Umfragen gestartet :(';
    }
        ?>
    </table>
</div>
