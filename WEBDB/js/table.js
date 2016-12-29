function addRows(tableid){
    
    var table = document.getElementById(tableid);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    
//    var cell1 = row.insertCell(0);
//    var element1 = document.createElement("input");
//    element1.type = "checkbox";
//    element1.name="chkbox[]";
//    cell1.appendChild(element1);


    var cell0 = row.insertCell(0);
    var element0 = document.createElement("Label");
    element0.innerHTML = "Antwort " + (rowCount);
    cell0.appendChild(element0);


    var cell1 = row.insertCell(1);
    var element1 = document.createElement("input");
    element1.type = "text";
    element1.name = "txtbox"+rowCount;
    cell1.appendChild(element1);
    
    var cell2 = row.insertCell(2);
    var element2 = document.createElement("input");
    element2.type = "checkbox";
    element2.name = "check"+rowCount;
    cell2.appendChild(element2);
}
function hello(){
    window.alert("hi");
}
document.onload = addRows('dataTable');
