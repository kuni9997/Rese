function onClick(id) {
    var inputId = id + "-input";
    var inputObj = document.getElementById(inputId);
    var divId = id + "-div"
    var divObj = document.getElementById(divId);
    if (inputObj.value == 0) {
        divObj.style.color = "#FFD700";
        inputObj.value = 1;
        console.log(inputObj.value)
    } else {
        divObj.style.color = "#ffffff";
        inputObj.value = 0;
        console.log(inputObj.value)
    }
}