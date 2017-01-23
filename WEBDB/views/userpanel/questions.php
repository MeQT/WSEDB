<?php
    // redirect if user is not logged in
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['User'])){
            header('Location: index.php?url=home/index');
        }
        error_reporting(E_ALL & ~E_NOTICE);
?>
<div class="container">
    
     <h3> Fragenübersicht</h3></br>
     <div class="form-group">
         <?php
            if(isset($_SESSION['QuestionAdded'])){
                echo $_SESSION['QuestionAdded'];
                unset($_SESSION['QuestionAdded']);
            }
         ?>
        <a href="index.php?url=question/index" class="btn btn-primary">Neue Frage erstellen</a>
     </div>
<?php

if(!empty($data) & $data != -1){
echo '<table class="table">';
    echo '<th>
        Frage
    </th>
    <th>
        Fragetyp
    </th>
    <th>
        Zeit
    </th>
    <th>
        Aktionen
    </th>';
        require_once 'models/questions.php';
        foreach($data as $entry){
            $count = 0;
            echo '<tr id="'.$entry->QuestionID.'"  >'; // onclick="hello('.$entry->QuestionID.')"
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
                echo '<ul class="btn btn-default dropdown">';//<li class="dropdown">';
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span><span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                //echo '<li>';
                echo '<form action="index.php?url=userpanel/editQuestion" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block" value="bearbeiten"/>';
                echo '</button>';
                echo '</form>';
                echo '<form action="index.php?url=userpanel/deleteQuestion" method="POST" OnClick="return confirm(\'Möchten Sie die Frage wirklich löschen?\');">';
                echo '<input type="hidden" name="id_to_delete" value="'.$entry->QuestionID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block" value="entfernen"/>';
                echo '</form>';
                //echo '</li>';
                echo '</ul>';
                echo '</ul>';
                echo '</td>';
                echo '<td>';
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