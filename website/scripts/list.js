function setColor(btn) {
    var property = document.getElementById(btn);
    var other = document.getElementsByClassName("otheruserlist");//some issue-> check
    other.style.backgroundColor = "rgb(236, 219, 246)";
    property.style.backgroundColor = "rgb(27, 194, 247)";
    
}