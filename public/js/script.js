function showFormModal(type){
    document.getElementsByClassName("overlay")[0].style.top = "0";
    document.getElementsByClassName("overlay")[0].style.left = "0";
    document.getElementsByClassName("overlay")[0].style.right = "0";
    document.getElementsByClassName("overlay")[0].style.bottom = "0";
}

function closeFormModal(){
    document.getElementsByClassName("overlay")[0].style.top = "-100%";
}

function updatePlayer(id){
    showFormModal("update");
}