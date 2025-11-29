function showFormModal(type){
    document.getElementById(type).style.top = "0";
    document.getElementById(type).style.width = "100vw";
    document.getElementById(type).style.height = "120vh";
}

function initializeInfo(type, id=null){
    if(type == "add"){
        document.getElementById("lastname").value = "";
        document.getElementById("firstname").value = "";
        document.getElementById("poste").value = "";
        document.getElementById("number").value = "";
        document.getElementById("type").value = "add";
        document.getElementById("type").name = "add";
        document.getElementById("id").value = "";
        document.getElementById("submit").value = "Ajouter";
    }
    else if(type == "update" && id != null){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.responseText != ""){
                data = JSON.parse(this.responseText);
                document.getElementById("lastname").value = data.lastname;
                document.getElementById("firstname").value = ""; //data.firstname;
                document.getElementById("poste").value = data.poste;
                document.getElementById("number").value = data.number;
                document.getElementById("type").value = "update";
                document.getElementById("type").name = "update";
                document.getElementById("id").value = id;
                document.getElementById("submit").value = "Modifier";
            }
        } 
        xmlhttp.open("GET", "https://localhost:8000/api/player/" + id, true);
        xmlhttp.send();
    }
    else if(type == "delete" && id != null){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.responseText != ""){
                data = JSON.parse(this.responseText);
                document.getElementById("name_delete").innerHTML = data.lastname;
                document.getElementById("poste_delete").innerHTML = data.poste;
                document.getElementById("number_delete").innerHTML = data.number;
                document.getElementById("id_delete").value = id;
                document.getElementById("submit").value = "Supprimer";
            }
        } 
        xmlhttp.open("GET", "https://localhost:8000/api/player/" + id, true);
        xmlhttp.send();
    }
}

function closeFormModal(type){
    document.getElementById(type).style.top = "-200%";
    document.getElementById(type).style.width = "0vw";
    document.getElementById(type).style.height = "0vh";
}

function updatePlayer(id){
    showFormModal("add_update");
    initializeInfo("update", id);
}

function deletePlayer(id){
    showFormModal("delete");
    initializeInfo("delete", id);
}
