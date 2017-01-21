<?php
require_once 'models/survey.php';
require_once 'models/questionairy.php';
$model = unserialize($data);
?>
<div class="container">
    Umfrageübersicht
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
        </th>
        <?php 
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
        ?>
    </table>
</div>
