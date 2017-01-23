function addRows(tableid){
    var elementsAbove = 3;
    var table = document.getElementById(tableid);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    
    var cell0 = row.insertCell(0);
    var element0 = document.createElement("Label");
    element0.innerHTML = "Antwort " + (rowCount - elementsAbove +1);
    cell0.appendChild(element0);

    var cell1 = row.insertCell(1);
    var element1 = document.createElement("input");
    element1.type = "text";
    element1.className = "form-control";
    element1.name = "AnswerText"+ (rowCount - elementsAbove +1);
    cell1.appendChild(element1);
    
    var cell2 = row.insertCell(2);
    var element2 = document.createElement("input");
    element2.type = "checkbox";
    element2.name = "RightOrWrong"+ (rowCount - elementsAbove +1);
    cell2.appendChild(element2);
}
function addRowsWithButton(tableid){
    var elementsAbove = 3;
    var table = document.getElementById(tableid);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.id = (rowCount - elementsAbove +1);
    
    var cell0 = row.insertCell(0);
    var element0 = document.createElement("Label");
    element0.innerHTML = "Antwort " + (rowCount - elementsAbove +1);
    cell0.appendChild(element0);

    var cell1 = row.insertCell(1);
    var element1 = document.createElement("input");
    element1.type = "text";
    element1.className = "form-control";
    element1.name = "AnswerText"+ (rowCount - elementsAbove +1);
    cell1.appendChild(element1);
    
    var cell2 = row.insertCell(2);
    var element2 = document.createElement("input");
    element2.type = "checkbox";
    element2.name = "RightOrWrong"+ (rowCount - elementsAbove +1);
    cell2.appendChild(element2);
    
    var command = "deleteRow(" +(rowCount - elementsAbove +1) +")";
    var cell3 = row.insertCell(3);
    var element3 = document.createElement("input");
    element3.type = "button";
    element3.className = "btn btn-default";
    element3.value = "entfernen";
    element3.setAttribute('onclick', command);
    cell3.appendChild(element3);
}
function hello(){
    window.alert("hi");
}
function addButton(){
    document.getElementById("alternative").style.visibility ="hidden";
    document.getElementById("startCode").style.visibility = "hidden";
    document.getElementById("timer").style.visibility = "hidden";
    document.getElementById("link").style.visibility = "hidden";
    var br = document.createElement("br");
    var form = document.getElementById("surveyForm");
    var submit = document.createElement("input");
    submit.type = "submit"
    submit.value = "Ergebnisse anzeigen";
    submit.innerHTML = "Ergebnisse anzeigen";
    submit.className = "btn btn-primary";
    form.appendChild(br);
    form.appendChild(submit);
}
function deleteRow(rowid)  
{   
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}
function submitQuestion(){
    document.getElementById('Answer').submit();
}
function copyQuestionairy(){
    var title = document.getElementById('Title').value;
    var description = document.getElementById('Description').value;
    document.getElementById('HiddenTitle').value = title;
    document.getElementById('HiddenDescription').value = description;
}
document.onload = addRows('dataTable');
