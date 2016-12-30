<div class="container">
        <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }  
        ?>
    <h2>Neuen Fragebogen erstellen</h2>
    <a href="index.php?url=nav/addquestionairy" class="btn btn-default">Neu anlegen</a>
    <table class="table">
        <?php //if(!empty($data) & $data != -1)
        if(1 == 1)
        {
            echo '<th>';
            echo 'Nr';
            echo '</th>';
            echo '<th>';
            echo 'Titel';
            echo '</th>';
            echo '<th>';
            echo 'Author';
            echo '</th>';
            echo '<th>';
            echo 'Fragen';
            echo '</th>';
        }
        else{
            echo '<br>Sie haben bisher keine Fragebögen angelegt :(';
        }
        ?>
            
            
        </th>
    </table>
</div>
