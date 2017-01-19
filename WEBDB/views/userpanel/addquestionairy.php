<div class="container">
    <form action="index.php?url=questionaire/saveQuestionary" method="POST" >
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $questions = $data[0];
            $courses = $data[1];
            if(!empty($data) & $data != -1){
                echo '<input type="submit" value="Speichern" class="btn btn-default"/>';
                echo '<br>';
                echo '<label for="Title">Name des Fragebogens</label>';
                echo '<input type="text" placeholder="Name des Fragebogens" name="Title" class="form-control"/>';
                if(isset($_SESSION['TitleMissing'])){
                    echo $_SESSION['TitleMissing'].'<br>';
                }
                echo '<label for="Description">Beschreibung</label>';
                echo '<textarea name="Description" rows="3" placeholder="Beschreibung" class="form-control"></textarea>';
                if(isset($_SESSION['DescriptionMissing'])){
                    echo $_SESSION['DescriptionMissing'].'<br>';
                }
                echo '<table class="table">';
                    echo '
                    <th>
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
                    </th>
                    <th>
                        Hinzufügen
                    </th>';
                        require_once 'models/questions.php';
                        for($i = 0; $i < count($questions);$i++){
                            $count = 0;
                            echo '<tr>';
                                echo '<td>';
                                echo $questions[$i]->QuestionID;
                                echo '</td>';
                                echo '<td>';
                                echo $questions[$i]->Text;
                                echo '</td>';
                                echo '<td>';
                                echo $questions[$i]->SelectionType;
                                echo '</td>';
                                echo '<td>';
                                echo $questions[$i]->Time;
                                echo '</td>';
                                echo '<td>';
                                echo '<input type="hidden" name="QuestionToAdd'.($i+1).'" value="'.$questions[$i]->QuestionID.'"/>';
                                echo '<input type="checkbox" class="form-control" name="AddQuestion'.($i + 1).'"/>';
                                echo '</td>';
                            echo '</tr>';
                        }
                echo '</table>';
                
                echo 'Kurszuordnung';
                echo '<select class="form-control" name="Course">';
                echo '<option value="0"></option>';
                for($i = 0; $i < count($courses);$i++){
                    echo '<option  value="'.$courses[$i]->CourseID.'">'.$courses[$i]->Text.'</option>';
                }
                echo '</select>';
            }
            else{
                echo 'Keine Fragen vorhanden :(';
            }
        ?>
    </form>
</div>


