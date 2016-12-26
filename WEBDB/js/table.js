/*
 * source: http://techstream.org/Web-Development/PHP/Dynamic-Form-Processing-with-PHP
 */
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 8){                            // limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i <colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Mehr als 8 Antwortmöglichkeiten sind nicht erlaubt");
			   
	}
    }
function countRows(tableID) {
        var inputs = document.getElementById()("chk"); //or document.forms[0].elements;
        var cbs = []; //will contain all checkboxes
        var checked = []; //will contain all checked checkboxes
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox") {
            cbs.push(inputs[i]);
                if (inputs[i].checked) {
                checked.push(inputs[i]);
                }
            }
        }
        window.alert(checked.length);
        document.QuestionForm.Checked.value = checked;
        //.forms['QuestionForm'].submit();
}

