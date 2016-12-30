<div class="container">
    <form method="POST" action="index.php?url=course/saveCourse">
        <input class="btn btn-primary" type="submit" value="Speichern"/>
        <table class="table">
            <tr>
                <td>
                    Name
                </td>
                <td>
                    <input class="form-control" type="text" name="Description"/>
                </td>
            </tr>
            <tr>
                <td>
                    Kürzel
                </td>
                <td>
                    <input class="form-control" type="text" name="Shortcut"/>
                </td>
            </tr>
        </table>
    </form>
</div>