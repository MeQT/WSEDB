<div class="container">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['CourseDelete'])){
        echo $_SESSION['CourseDelete'];
        unset($_SESSION['CourseDelete']);
    }
    if(isset($_SESSION['CourseEdited'])){
        echo $_SESSION['CourseEdited'];
        unset($_SESSION['CourseEdited']);
    }
    echo '<a href="index.php?url=nav/addCourse" class="btn btn-primary">Neue Veranstaltung erstellen</a>';
    echo '<br>';
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
                        Veranstaltung
                    </th>
                    <th>
                        Aktion
                    </th>
                    <th>
                    </th>';
            for($i = 0; $i < count($data->Courses); $i++){
                echo '<tr>';
                echo '<td>';
                echo $data->Courses[$i]->Shortcut;
                echo '</td>';
                echo '<td>';
                echo $data->Courses[$i]->Text;
                echo '</td>';
                echo '<td>';
                echo '<form action="index.php?url=nav/editCourse" method="POST">';
                echo '<input type="hidden" name="id_to_edit" value="'.$data->Courses[$i]->CourseID.'"/>';
                echo '<input type="submit" class="btn btn-primary" value="bearbeiten"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';;
                echo '<form action="index.php?url=courseController/deleteCourse" method="POST">';
                echo '<input type="hidden" name="id_to_delete" value="'.$data->Courses[$i]->CourseID.'"/>';
                echo '<input type="submit" class="btn btn-primary" value="entfernen"/>';
                echo '</form>';
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

