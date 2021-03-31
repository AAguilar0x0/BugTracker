function escapeSpecialChars(jsonString) {
    return jsonString.replace(/\n/g, "\\n")
        .replace(/\r/g, "\\r")
        .replace(/\t/g, "\\t")
        .replace(/\f/g, "\\f");
}
function update(elem) {
    document.getElementsByName("bugid")[0].value = elem.getAttribute("value");
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/updateContent.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            let values = JSON.parse(escapeSpecialChars(xhr.response));
            document.getElementsByName("titleup")[0].value = values[0];
            document.getElementsByName("descriptionup")[0].value = values[1];
            document.getElementsByClassName('modal')[1].style.display = "block";
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("bugId="+elem.getAttribute("value"));
}
function deleteBug(elem) {
    if(confirm("Are you sure you want to delete this?") == false){
        return;
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/delete.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            let thisElem = document.getElementById("bugItem"+elem.getAttribute("value"));
            let parent = thisElem.parentNode;
            thisElem.innerHTML = "";
            thisElem.parentNode.removeChild(thisElem);
            parent.innerHTML = parent.getElementsByClassName("bugShort").length == 0 ? 
                "<span class=\"NO_DATA\">NO DATA</span>" : parent.innerHTML;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("bugId="+elem.getAttribute("value"));
}
function resolve(elem){
    let bugscontent = document.getElementsByClassName("bugscontent")[1];
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/resolve.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            if(elem.parentNode.parentNode == bugscontent){
                elem.innerHTML = "Request Resolved";
                elem.setAttribute('onclick','reqresolved(this)');
                return;
            }
            let parent = elem.parentNode;
            parent.innerHTML = "";
            parent.parentNode.removeChild(parent);
            let unresolved = document.getElementsByClassName("bugscontent")[0];
            unresolved.innerHTML = unresolved.getElementsByClassName("bugShort").length == 0 ? 
                "<span class=\"NO_DATA\">NO DATA</span>" : unresolved.innerHTML;
            bugscontent.innerHTML = bugscontent.innerHTML.includes("<span class=\"NO_DATA\">NO DATA</span>") ? "" : bugscontent.innerHTML;
            bugscontent.innerHTML += xhr.response;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("bugId="+elem.getAttribute("value"));
}
function viewdetails(elem){
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/viewdetails.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            let values = JSON.parse(escapeSpecialChars(xhr.response));
            let modal = document.getElementsByClassName('modal')[2];
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
function reqresolved(elem){
    if(confirm("Are you sure you want to request\nthat this has been solved by you?") == false){
        return;
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/reqresolved.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            elem.classList.remove("itemsHovFX");
            elem.style.color = "unset";
            elem.style.cursor = "default";
            elem.setAttribute("onclick","");
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("bugId="+elem.getAttribute("value"));
}
function searchUnresolved(elem){
    let bugscontent = document.getElementsByClassName("bugscontent")[0];
    let param = document.getElementsByName("param")[0].value;
    let key = elem.value;
    if(param == ""){
        return;
    }
    let location = "action/searchUnresolved.php";
    if(key == ""){
        location = "action/updateUnresolved.php";
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',location);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            bugscontent.innerHTML = "";
            bugscontent.innerHTML = xhr.response;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("key="+key+"&param="+param);
}
function searchResolving(elem){
    let bugscontent = document.getElementsByClassName("bugscontent")[1];
    let param = document.getElementsByName("param")[1].value;
    let key = elem.value;
    if(param == ""){
        return;
    }
    let location = "action/searchResolving.php";
    if(key == ""){
        location = "action/updateResolving.php";
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',location);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            bugscontent.innerHTML = "";
            bugscontent.innerHTML = xhr.response;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("key="+key+"&param="+param);
}
function searchResolved(elem){
    let bugscontent = document.getElementsByClassName("bugscontent")[2];
    let param = document.getElementsByName("param")[2].value;
    let key = elem.value;
    if(param == ""){
        return;
    }
    let location = "action/searchResolved.php";
    if(key == ""){
        location = "action/updateResolved.php";
    }
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',location);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            bugscontent.innerHTML = "";
            bugscontent.innerHTML = xhr.response;
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("key="+key+"&param="+param);
}
function viewdetailsResolved(elem){
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST',"action/viewdetailsResolved.php");
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) {
            let values = JSON.parse(escapeSpecialChars(xhr.response));
            let modal = document.getElementsByClassName('modal')[3];
            modal.getElementsByClassName('neuL')[0].getElementsByTagName('SPAN')[0].innerHTML = values[0];
            modal.getElementsByClassName('neuL')[1].getElementsByTagName('SPAN')[0].innerHTML = values[1];
            modal.getElementsByClassName('neuL')[2].getElementsByTagName('SPAN')[0].innerHTML = values[2];
            modal.getElementsByClassName('neuL')[3].getElementsByTagName('SPAN')[0].innerHTML = values[3];
            modal.getElementsByClassName('neuL')[4].getElementsByTagName('PRE')[0].innerHTML = values[4];
            modal.style.display = "block";
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("bugId="+elem.getAttribute("value"));
}