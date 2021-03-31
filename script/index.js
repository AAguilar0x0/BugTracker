function viewdetails(elem){
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/viewdetails.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            let values = JSON.parse(escapeSpecialChars(xhr.response));
            let modal = document.getElementsByClassName('modal')[0];
            modal.getElementsByClassName('neuL')[0].getElementsByTagName('SPAN')[0].innerHTML = values[0];
            modal.getElementsByClassName('neuL')[1].getElementsByTagName('SPAN')[0].innerHTML = values[1];
            modal.getElementsByClassName('neuL')[2].getElementsByTagName('SPAN')[0].innerHTML = values[2];
            modal.getElementsByClassName('neuL')[3].getElementsByTagName('PRE')[0].innerHTML = values[3];
            modal.style.display = "block";
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("bugId="+elem.getAttribute("value"));
}
function updateResBugs(){
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/updateResBugs.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            document.getElementsByClassName('content')[0].getElementsByClassName("neuL")[2].getElementsByTagName('SPAN')[0].innerHTML = xhr.response;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();
}
function acknowledge(elem){
    if(confirm("Are you sure you want to acknowledge?\nAfter clicking acknowledge, all requests\nwith the same title will be denied automatically.")
        == false){
            return;
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/acknowledge.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            let id = elem.getAttribute("value");
            let request = document.getElementsByClassName("userRequest");
            for(let i = 0; request[i] != null; i++){
                if(request[i].getAttribute("value") == id){
                    let node = request[i--];
                    node.parentNode.removeChild(node);
                }
            }
            let reqContainer = document.getElementsByClassName("requests")[0];
            reqContainer.innerHTML = document.getElementsByClassName("userRequest").length == 0 ? 
                "<span class=\"NO_DATA\">NO DATA</span>" : reqContainer.innerHTML;
            if(elem.getAttribute("usrnm") == elem.getAttribute("currusrnm")){
                updateResBugs();
            }
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("username="+elem.getAttribute("usrnm")+"&bugId="+elem.getAttribute("value"));
}
function deny(elem){
    if(confirm("Are you sure you want to deny?\nAfter clicking deny,\nthe request is deleted.")
        == false){
            return;
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/deny.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            elem.parentNode.parentNode.removeChild(elem.parentNode);
            let reqContainer = document.getElementsByClassName("requests")[0];
            reqContainer.innerHTML = document.getElementsByClassName("userRequest").length == 0 ? 
                "<span class=\"NO_DATA\">NO DATA</span>" : reqContainer.innerHTML;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("username="+elem.getAttribute("usrnm")+"&bugId="+elem.getAttribute("value"));
}
function searchReqResolved(elem){
    let requests = document.getElementsByClassName("requests")[0];
    let param = document.getElementsByName("param")[0].value;
    let key = elem.value;
    if(param == ""){
        return;
    }
    let location = "action/searchReqResolved.php";
    if(key == ""){
        location = "action/updateReqResolved.php";
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',location);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            requests.innerHTML = "";
            requests.innerHTML = xhr.response;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("key="+key+"&param="+param);
}