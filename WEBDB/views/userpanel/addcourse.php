<div class="container">
    <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['DescriptionMissing'])){
            echo $_SESSION['DescriptionMissing'];
        }
        if(isset($_SESSION['ShortcutMissing'])){
            echo $_SESSION['ShortcutMissing'];
        }
    ?>
    <form method="POST" action="index.php?url=courseController/saveCourse">
        <input class="btn btn-primary" type="submit" value="Speichern"/>
        <table class="table">
            <tr>
                <td>
                    Name
                </td>
                <td>
                    <input class="form-control" type="text" name="description"/>
                </td>
            </tr>
            <tr>
                <td>
                    Kürzel
                </td>
                <td>
                    <input class="form-control" type="text" name="shortcut"/>
                </td>
            </tr>
        </table>
    </form>
</div>