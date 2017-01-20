<div class="container">
     <h3> Fragenübersicht</h3></br>
     <a href="index.php?url=question/index" class="btn btn-primary">Neue Frage erstellen</a>
<?php
if(!empty($data) & $data != -1){
echo '<table class="table">';
    echo '<th>
        Nr
        </th>
    <th>
        Frage
    </th>
    <th>
        Fragetyp
    </th>
    <th>
        Zeit
    </th>
    <th>
        Bearbeiten
    </th>
    <th>
        Entfernen
    </th>';
        require_once 'models/questions.php';
        foreach($data as $entry){
            $count = 0;
            echo '<tr id="'.$entry->QuestionID.'"  >'; // onclick="hello('.$entry->QuestionID.')"
                echo '<td>';
                echo $entry->QuestionID;
                echo '</td>';
                echo '<td>';
                echo $entry->Text;
                echo '</td>';
                echo '<td>';
                if($entry->SelectionType == '0')
                    {echo ' Einzelauswahl';}
                    else if($entry->SelectionType == '1')
                    {echo ' Mehrfachauswahl';}
                    else {echo ' Freitext';}
                echo '</td>';
                echo '<td>';
                echo $entry->Time . ' Sek';
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=userpanel/editQuestion" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-xs" value="bearbeiten"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=userpanel/deleteQuestion" method="POST">';
                echo '<input type="hidden" name="id_to_delete" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-xs" value="entfernen"/>';
                echo '</form>';
                echo '</td>';
            echo '</tr>';
        }
echo '</table>';
}
if($data == -1){
    echo 'Sie haben noch keine Fragen angelegt';
}
?>
     <table>
    <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }   
        if(isset($_SESSION['QuestionAdded'])){
            echo filter_var($_SESSION['QuestionAdded']);
        }
        unset($_SESSION['QuestionAdded']);
        if(isset($_SESSION['DeleteComplete'])){
            echo filter_var($_SESSION['DeleteComplete']);
        }
        unset($_SESSION['DeleteComplete']);
        if(isset($_SESSION['QuestionEdited'])){
            echo filter_var($_SESSION['QuestionEdited']);
        }
        unset($_SESSION['QuestionEdited']);

    ?>
</table>
</div>