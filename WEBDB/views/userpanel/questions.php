<div class="container">
<table>
    <tr>
        <td>
            <?php echo '<a href="index.php?url=question/index" class="btn btn-default">Neue Frage erstellen</a>'?>
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
<?php
if(!empty($data) & $data != -1){
echo '<table class="">';
    echo '<th>
        ID
    </th>
    <th>
        Frage
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
            echo '<tr>';
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
                echo '<input type="submit" value="bearbeiten"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=userpanel/deleteQuestion" method="POST">';
                echo '<input type="hidden" name="id_to_delete" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" value="entfernen"/>';
                echo '</form>';
                echo '</td>';
            echo '</tr>';
        }
echo '</table>';
}
if($data == -1){
    echo 'Sie haben noch keine Fragen angelegt :(';
}
?>
</div>