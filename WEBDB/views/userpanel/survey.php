<?php
    require_once 'models/surveyModel.php';
    require_once 'models/survey.php';
    require_once 'models/questionairy.php';
    require_once 'models/questionaryModel.php';
    require_once 'models/questions.php';
    $model = unserialize($data);
    $time = 0;
    for ($i = 0; $i < count($model->Questions);$i++){
        $time += $model->Questions[$i]->Time;
    }
    
    $timestring = getTimeString($time);
    
    
    function getTimeString($time){
        $minutes = 0;
        while($time >= 60){
            $time -= 60;
            $minutes++;
        }
        $seconds = $time;
        if($minutes > 0){
            $output = $minutes.':'.$seconds.' Minuten';
        }
        else{
            $output = $seconds.' Sekunden';
        }
        return $output;
    }
    ?>
<div class="container">
    <form action="index.php?url=surveyController/start" method="POST">
        Umfrage starten
        <table>
            <tr>
                <td>
                    <input type="number" name="time" class="form-control" required="required"/>
                </td>
                <td>
                    <input type="submit" class="btn btn-default" value="starten"/>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="help-block">Angabe in Minuten</span>
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $model->Questionairy->Title;?>
                </td>
                <td>
                    Dauer: <?php echo' '.$timestring;?>
                </td>
            </tr>
        </table>      
        
        <?php
        echo '<table class="table">';
        for ($i = 0; $i < count($model->Questions);$i++){
            echo '<tr><td>';
            echo $model->Questions[$i]->Text;
            echo '</td></tr>';
        }
        echo '</table>';
        echo '<input type="hidden" name="model" value="'. base64_encode($model->Questionairy->QuestionairyID).'"/>'?>
    </form>
</div>
