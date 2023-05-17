function SetRequest(contr='',id='',jd='',kd=''){
    const request = new XMLHttpRequest()
    let url ="../models/rquest.php/?cont="+contr
    if (id!='') {url += '&id='+id}
    if (jd!='') {url += '&jd='+jd}
    if (kd!='') {url += '&kd='+kd}
    // alert (url);
    request.open("GET", url);
    request.send();
    // alert (request.responseText);
    request.onreadystatechange=function (){
        if (request.readyState === 4  && request.status===200) {
            const studentBlock = document.getElementById("biblio-block");
            studentBlock.innerHTML=request.responseText;
        }
    }

}
function f1() {
    var f = document.getElementById("a_id").value;
    SetRequest("theatres",f);
}
function f2(){
    var f = document.getElementById("b_id").value;
    SetRequest("halls",f);
}
function f3(){
    var f = document.getElementById("c_id").value;
    SetRequest("seances",'',f);
}
function f4(){
    var f = document.getElementById("d_id").value;
    SetRequest("movies",f);
}
function f5(){
    var f = document.getElementById("e_id").value;
    SetRequest('places',f,'',2);
}
function f6(){
    var f = document.getElementById("e_id").value;
    SetRequest('places',f,'',1);
}
function f7(){
    var f = document.getElementById("e_id").value;
    SetRequest('places',f,'',0);
}
function f8(){
    var f = document.getElementById("f_id").value;
    var g = document.getElementById("g_id").value;
    var h = document.getElementById("h_id").value;
    url="http://localhost/PHP30/5/v1/places/?token=c817837ff6fa7780ad8b2f5b64e73588&id="+f+"&free=0"
    request = new XMLHttpRequest();
    data = '{"seance":'+f+',"status":2,"row":'+g+',"number":'+h+'}'
    request.open("POST", url,false);
    request.setRequestHeader("Content-type", "application/json")
    request.send(data)
    alert(request.responseText);

}

//     //

// document.getElementById("f2").onclick  = async (e) => {
// alert ('ff');
// }
