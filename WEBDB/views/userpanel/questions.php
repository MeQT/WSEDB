<div class="container">
     <h3> Ihre Fragenübersicht</h3></br>
<?php
if(!empty($data) & $data != -1){
echo '<table class="table">';
    echo '<th>
        Nummer
    </th>
    <th>
        Text
    </th>
    <th>
        Auswahltyp
    </th>
    <th>
        Zeit
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
                echo $entry->SelectionType;
                echo '</td>';
                echo '<td>';
                echo $entry->Time;
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=userpanel/editQuestion" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" class="btn-primary" value="bearbeiten"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=userpanel/deleteQuestion" method="POST">';
                echo '<input type="hidden" name="id_to_delete" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" class="btn-primary" value="entfernen"/>';
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
    <tr>
        <td>
            <?php echo '<a href="index.php?url=question/index" class="btn btn-primary">Neue Frage erstellen</a>'?>
            <p style="margin-bottom: 25px"></p>
        </td>
    </tr>
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