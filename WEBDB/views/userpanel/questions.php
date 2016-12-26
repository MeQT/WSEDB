<table>
    <tr>
        <td>
            <?php echo '<a href="index.php?url=question/index" class="btn btn-default">Neue Frage erstellen</a>'?>
        </td>
        <td>
            <?php echo '<a href="index.php?url=userpanel/showEditQuestion" class="btn btn-default">Frage bearbeiten</a>'?>
        </td>
        <td>
            <?php echo '<a href="index.php?url=userpanel/showDeleteQuestion" class="btn btn-default">Neue Frage erstellen</a>'?>
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
            echo '</tr>';
        }
echo '</table>';
}
if($data == -1){
    echo 'Sie haben noch keine Fragen angelegt :(';
}
?>