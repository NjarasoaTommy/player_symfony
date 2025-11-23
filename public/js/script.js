function showFormModal(type){
    document.getElementsByClassName("overlay")[0].style.top = "0";
    document.getElementsByClassName("overlay")[0].style.width = "100vw";
    document.getElementsByClassName("overlay")[0].style.height = "100vh";
}

function closeFormModal(){
    document.getElementsByClassName("overlay")[0].style.top = "-100%";
    document.getElementsByClassName("overlay")[0].style.width = "0vw";
    document.getElementsByClassName("overlay")[0].style.height = "0vh";
}

function updatePlayer(id){
    showFormModal("update");
}