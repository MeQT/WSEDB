<div class="container">
        <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }  
        if(isset($_SESSION['QuestionairyEdited'])){
            echo $_SESSION['QuestionairyEdited'];
            unset($_SESSION['QuestionairyEdited']);
        }
        require_once 'models/questionairy.php';
        ?>
    <h2>Ihre Fragebögenübsicht</h2>
    <a href="index.php?url=nav/addquestionairy" class="btn btn-default">Neu anlegen</a>
    <table class="table">
        <?php
        if(!empty($data) & $data != -1){
            echo '<th>';
            echo 'Nr';
            echo '</th>';
            echo '<th>';
            echo 'Titel';
            echo '</th>';
            echo '<th>';
            echo 'Beschreibung';
            echo '</th>';
            echo '<th>';
            echo 'Kurs';
            echo '</th>';
            echo '<th>';
            echo 'Erstellungsdatum';
            echo '</th>';
            echo '<th>';
            echo 'Bearbeiten';
            echo '</th>';
            echo '<th>';
            echo 'Entfernen';
            echo '</th>';
            echo '<th>';
            echo 'Starten';
            echo '</th>';
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>';
                echo $row->QuestionairyID;
                echo '</td>';
                echo '<td>';
                echo $row->Title;
                echo '</td>';
                echo '<td>';
                echo $row->Description;
                echo '</td>';
                echo '<td>';
                echo $row->Course;
                echo '</td>';
                echo '<td>';
                echo $row->DateOfCreation;
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=questionaire/editQuestionairy" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$row->QuestionairyID.'"/>';
                echo '<input type="submit" value="bearbeiten"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=questionaire/deleteQuestionairy" method="POST">';
                echo '<input type="hidden" name="id_to_delete" value="'.$row->QuestionairyID.'"/>';
                echo '<input type="submit" value="entfernen"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=surveyController/setup" method="POST">';
                echo '<input type="hidden" name="id_to_start" value="'.$row->QuestionairyID.'"/>';
                echo '<input type="submit" value="starten"/>';
                echo '</form>';
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
