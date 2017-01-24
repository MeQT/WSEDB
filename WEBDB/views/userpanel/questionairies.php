<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
?>
<div class="container">
    <h3>Fragebögenübersicht</h3></br>
       <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }  
        require_once 'models/questionairy.php';
        ?>
    <div class="form-group">
    <a href="index.php?url=nav/addquestionairy" class="btn btn-primary">Neuen Fragebogen erstellen</a>
    <?php 
        if(isset($_SESSION['QuestionairyEdited'])){
            echo '<div>';
            echo '<span id="hilfeText" class="help-block">';
            echo $_SESSION['QuestionairyEdited'];
            unset($_SESSION['QuestionairyEdited']);
            echo '</span>';
            echo '</div>';
        }
        if(isset($_SESSION['QuestionairyAdded'])){
            echo '<div>';
            echo '<span id="hilfeText" class="help-block">';
            echo $_SESSION['QuestionairyAdded'];
            unset($_SESSION['QuestionairyAdded']);
            echo '</span>';
            echo '</div>';
        }
    ?>
    </div>
    <table class="table">
        <?php
        if(!empty($data) & $data != -1){
            echo '<th>';
            echo 'Fragebogen';
            echo '</th>';
            echo '<th>';
            echo 'Kurs';
            echo '</th>';
            echo '<th>';
            echo 'Erstellungsdatum';
            echo '</th>';
            echo '<th>';
            echo 'Aktionen';
            echo '</th>';
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td class="col-xs-6">';
                echo $row->Title;
                echo '</td>';
                echo '<td class="col-xs-1">';
                echo $row->CourseName;
                echo '</td>';
                echo '<td class="col-xs-2">';
                echo $row->DateOfCreation;;
                echo '</td>';
                echo '<td class="col-xs-2">';
                echo '<ul class="btn btn-default dropdown">';//<li class="dropdown">';
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-collapse-down" style="color:purple" aria-hidden="true"></span><span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                echo '<form action="index.php?url=questionaire/editQuestionairy" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$row->QuestionairyID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block" value="bearbeiten"/>';
                echo '</form>';
                echo '<form action="index.php?url=questionaire/deleteQuestionairy" method="POST" OnClick="return confirm(\'Möchten Sie den Fragebogen wirklich löschen?\');">';
                echo '<input type="hidden" name="id_to_delete" value="'.$row->QuestionairyID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block" value="entfernen"/>';
                echo '</form>';
                echo '<form action="index.php?url=surveyController/setup" method="POST">';
                echo '<input type="hidden" name="id_to_start" value="'.$row->QuestionairyID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block" value="starten"/>';
                echo '</form>';
                echo '</ul>';
                echo '</ul>';                
                echo '</td>';
                echo '</tr>';
            } 
        }
        else{
            echo '<br>Sie haben bisher keine Fragebögen angelegt :(';
        }
        ?>        
        </th>
    </table>
</div>
