//window.confirm("hey mah boi");
//console.log("nae tootab v midagi");

window.onload = function(){
    document.getElementById("submitPic").disabled = true;
    document.getElementById("notice").innerHTML = "vali pilt";
    document.getElementById("fileToUpload").addEventListener("change", checkSize);
}

function checkSize(){
    //console.log(document.getElementById("fileToUpload").files[0]);
    if(document.getElementById("fileToUpload").files[0].size <= 500000){
        document.getElementById("submitPic").disabled = false;
        document.getElementById("notice").innerHTML = "";
    }else{
        document.getElementById("notice").innerHTML = "valitud on liiga suur pilt";
        document.getElementById("submitPic").disabled = true;
    }
}