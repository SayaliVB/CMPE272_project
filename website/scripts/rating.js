function getCookie() {
    var name ='userid';
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    var elements = document.getElementsByTagName("input");
    if (parts.length === 2){
        return true;
        //return parts.pop().split(';').shift();
    }
    else{
        alert("Please login first!!");

        for (var i = 0; i < elements.length; i++) {
                if (elements[i].type == "radio") {
                    elements[i].checked = false;
                }
            }
        return false;
    }
}

function resetButton() {
    /*
    var name ='user_id';
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    var elements = document.getElementsByTagName("input");
    if (parts.length === 2){
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].type == "radio") {
                elements[i].checked = false;
            }
        }
        return true;
        //return parts.pop().split(';').shift();
    }
    else{
        alert("Please login first!!");
        return false;
    }
    */
}