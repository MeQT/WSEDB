<div class="container">
    <?php 
    echo '<a href="index.php?url=nav/addCourse" class="btn btn-primary">Neue Veranstaltung erstellen</a>';
    echo '<br>';
    ?>
    <table class="table">
        <?php
        if(!empty($data) && $data != -1){
            require_once 'models/courseModel.php';
            require_once 'models/course.php';
            for($i = 0; $i < count($data->Courses); $i++){
                echo '        
                     <th>
                        Kürzel
                     </th>
                     <th>
                        Veranstaltung
                    </th>
                    <th>
                        Aktion
                    </th>';
                echo '<tr>';
                echo $data->Courses[$i]->Shortcut;
                echo '<td>';
                echo '</td>';
                echo '<td>';
                echo '</td>';
                echo '<td>';
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

