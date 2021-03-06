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
    <h3> Kursübersicht</h3></br>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    echo '<div class="form-group">';
    echo '<a href="index.php?url=nav/addCourse" class="btn btn-primary">Neuen Kurs erstellen</a>';
    echo '</div>';
    
        if(isset($_SESSION['CourseAdded'])){
            echo '<div>';
            echo '<span id="hilfeText" class="help-block">';
            echo $_SESSION['CourseAdded'];
            unset($_SESSION['CourseAdded']);
            echo '</span>';
            echo '</div>';
        }
        if(isset($_SESSION['CourseDelete'])){
            echo '<div>';
            echo '<span id="hilfeText" class="help-block">';
            echo $_SESSION['CourseDelete'];
            unset($_SESSION['CourseDelete']);
            echo '</span>';
            echo '</div>';
        }
        if(isset($_SESSION['CourseEdited'])){
            echo '<div>';
            echo '<span id="hilfeText" class="help-block">';
            echo $_SESSION['CourseEdited'];
            unset($_SESSION['CourseEdited']);
            echo '</span>';
            echo '</div>';
        }
    ?>
    <table class="table">
        <?php
        require_once 'models/courseModel.php';
        if(!empty($data) && $data->Courses != -1){
            require_once 'models/course.php';
            echo '        
                     <th>
                        Kürzel
                     </th>
                     <th>
                        Kurs
                    </th>
                    <th>
                        Aktionen
                    </th>';
            for($i = 0; $i < count($data->Courses); $i++){
                echo '<tr>';
                echo '<td class="col-xs-2">';
                echo $data->Courses[$i]->Shortcut;
                echo '</td>';
                echo '<td class="col-xs-6">';
                echo $data->Courses[$i]->Text;
                echo '</td>';
                echo '<td class="col-xs-2">';
                echo '<ul class="btn btn-default dropdown">';//<li class="dropdown">';
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color:purple" aria-expanded="false"><span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span><span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                echo '<form action="index.php?url=nav/editCourse" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$data->Courses[$i]->CourseID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block" value="bearbeiten"/>';
                echo '</form>';
                echo '<form action="index.php?url=courseController/deleteCourse" method="POST" OnClick="return confirm(\'Möchten Sie diesen Kurs wirklich löschen?\');">';
                echo '<input type="hidden" name="id_to_delete" value="'.$data->Courses[$i]->CourseID.'"/>';
                echo '<input type="submit" class="btn btn-primary btn-block"" value="entfernen"/>';
                echo '</form>';
                echo '</ul>';
                echo '</ul>'; 
                echo '</td>';
                echo '</tr>';  
            }
        }
        else{
            echo 'Keine Kurse :(';
        }
        ?>
    </table>
</div>

