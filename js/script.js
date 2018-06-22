
var ajaxrequest = new XMLHttpRequest();
var data;
var traitement = "";
/* addListeMemes(); */


function requestajax(dataToSend, route) {
    submitMethod = "POST";
    //submitMethod = "GET"
    var pageUrl = "initsearch.php";
    syncMethod = true; // Méthode asynchrone
    syncMethod = false; // Méthode Syncrone
    //user = "" //nom d'utilisateur as string si "pageUrl" est sécurisée
    //password = "" // mot de passe as string si "pageUrl" est sécurisée

    ajaxrequest.open(submitMethod, pageUrl, true);
    if (submitMethod == "POST") {
        ajaxrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    }
    //alert(dataToSend);
    ajaxrequest.send(dataToSend);
 


}

//******************
 ajaxrequest.onreadystatechange = function () {
    switch (ajaxrequest.readyState) {
        case 0: stateUninitialized(); break; // 0 (uninitialized)	Objet non initialisé
        case 1: stateLoading(); break; // 1 (loading)	Début du transfert des données
        case 2: stateLoaded(); break; // 2 (loaded)	Données transférées
        case 3: stateInteractive(); break; // 3 (interactive)	Données reçues sont accessibles en partie
        case 4: stateCompleteImage(); break; // 4 (complete)	Données sont complètement accessibles
    }
} 

function stateCompleteImage(){

    /* ajaxrequest.responseType = "arraybuffer"; */
    var tmp = ajaxrequest.response;
/*      alert(tmp);
 */     var urlImageMeme = tmp.split("!!");

/*      alert(urlImageMeme[0]);
 */     document.getElementById('imgFinalRender').src = urlImageMeme[0];
}

function stateComplete() {
    var tmp = ajaxrequest.responseText //.split(":");
    //if (typeof (tmp[1]) != "undefined") {
    //    f.elements["string1_r"].value = tmp[1];
    //    f.elements["string2_r"].value = tmp[2];
    //}
    //for (var i = 0; i < tmp.length; i++) {
    //alert("stateComplete" + tmp);


    listeNm(tmp);
    //alert(traitement);
    //switch (traitement) {
    //    case "getSaisie": listeNm(tmp); break;
    //    case "getInfos": writeInfos(tmp); break;
    //}

    traitement = "";

}

    function listeNm(tmp) {
        var lstnm = tmp.split(";");
        document.getElementById("listmemes").innerHTML = "";
        //alert(lstnm);
        for (var i = 0; i < lstnm.length; i++) {
            var infosMeme = lstnm[i].split(":");
            var listeDeMeme = document.createElement("OPTION");
            listeDeMeme.setAttribute("value", infosMeme[1]);
            listeDeMeme.setAttribute("data-idmeme", infosMeme[0]);
            //listeDeMeme.setAttribute("onclick", "alert('text=' + this.id);");
            document.getElementById("listmemes").appendChild(listeDeMeme);
            //alert(infosMeme[0]);
        }
        //*******************
        var monbouton = document.getElementById("SearchButton");
        //alert("nbelem = " + document.getElementById("listmemes").options.length);
        
        if (document.getElementById("listmemes").options.length <= 2) {window.focus();};

    }

    function writeInfos(tmp) {
        //alert(tmp);
        document.getElementById("infos").innerHTML = tmp;
        
}
function stateInteractive() {
    var tmp = ajaxrequest.responseText;//.split(":");
    //if (typeof (tmp[1]) != "undefined") {
    //    f.elements["string1_r"].value = tmp[1];
    //    f.elements["string2_r"].value = tmp[2];
    //}
    for (var i = 0; i < tmp.length; i++) {
        //alert("stateInteractive" + tmp[i]);
    }
}

function stateLoaded() {
    var tmp = ajaxrequest.responseText; //.split(":");
    //if (typeof (tmp[1]) != "undefined") {
    //    f.elements["string1_r"].value = tmp[1];
    //    f.elements["string2_r"].value = tmp[2];
    //}
    for (var i = 0; i < tmp.length; i++) {
        //alert("stateLoaded" + tmp[i]);
    }
}

function stateLoading() {
    var tmp = ajaxrequest.responseText; //.split(":");
    //if (typeof (tmp[1]) != "undefined") {
    //    f.elements["string1_r"].value = tmp[1];
    //    f.elements["string2_r"].value = tmp[2];
    //}
    for (var i = 0; i < tmp.length; i++) {
        //alert("stateLoading" + tmp[i]);
    }
}

function stateUninitialized() {
    ajaxrequest.responseType = "blob";
   /*  var tmp = ajaxrequest.responseText; *///.split(":");
    //if (typeof (tmp[1]) != "undefined") {
    //    f.elements["string1_r"].value = tmp[1];
    //    f.elements["string2_r"].value = tmp[2];
    //}
/*     for (var i = 0; i < tmp.length; i++) {
 */        //alert("stateUninitialized" + tmp[i]);
    /* } */
}

// **************************

function addListeMemes() {
    var rechercheMeme = document.createElement("INPUT");
    rechercheMeme.setAttribute("id", "search");
    rechercheMeme.setAttribute("type", "search");
    rechercheMeme.setAttribute("required","");
    rechercheMeme.setAttribute("list", "listmemes");
    rechercheMeme.setAttribute("placeholder", "rechercher un meme");
    rechercheMeme.setAttribute("onkeyup", "autocompletion(this.value);");

    document.getElementById("searchzone").appendChild(rechercheMeme);
    var inhtm = document.getElementById("searchzone").innerHTML;
    document.getElementById("searchzone").innerHTML = inhtm + '<label class="label-icon" for="search"><i id="SearchButton" onclick="chercheInfos();" class="material-icons">search</i></label><i class="material-icons" onclick="clearSearh();" >close</i>';
 
    var dataListeMemes = document.createElement("DATALIST");
    dataListeMemes.setAttribute("id", "listmemes");
    document.getElementById("searchzone").appendChild(dataListeMemes);

    var listeDeMeme = document.createElement("OPTION");
    listeDeMeme.setAttribute("value", "");
    listeDeMeme.setAttribute("data-idmeme", "");
    document.getElementById("listmemes").appendChild(listeDeMeme);
}

function clearSearh() {
    document.getElementById("search").value = ""
    document.getElementById("listmemes").innerHTML=""
}


function autocompletion(textesaisi) {
    //alert("text = " + textesaisi);

    if (textesaisi == "") { clearSearh() ;return; };

    data = "saisie=" + textesaisi + "%";
  
    traitement = "getSaisie";
    requestajax(data);
    return true
};

function chercheInfos() {
    var selectionMeme = document.getElementById("listmemes");//document.getElementById("search").value;

    //alert("id du meme sélectionné " + selectionMeme.options[0].dataset.idmeme);
    var memeId = "meme/" + selectionMeme.options[0].dataset.idmeme;
    //alert("chemin : " + memeId);
    window.location = memeId;
    //return;
    //data = "infos=" + selectionMeme.options[0].id;//+ "%";
    //traitement = "getInfos";
    //requestajax(data);
    
    return true
};
function sendMemeAjax(dataToSend) {
    submitMethod = "POST";
    //submitMethod = "GET"
    var pageUrl = "./meme/creatememe";
    syncMethod = true; // Méthode asynchrone
    syncMethod = false; // Méthode Syncrone
    //user = "" //nom d'utilisateur as string si "pageUrl" est sécurisée
    //password = "" // mot de passe as string si "pageUrl" est sécurisée

    ajaxrequest.open(submitMethod, pageUrl, true);
    if (submitMethod == "POST") {
        ajaxrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    }
/*     alert(dataToSend);
 */    ajaxrequest.send(dataToSend);
}

function ChangeImage(a) {
    document.getElementById("imgDisplay").src = a;

  /*   imgDisplay.style.width = '90%';
    imgDisplay.style.height = '90%'; */
}

var currentImagePath = "";

function sendData(){

    if(document.getElementById("txt1")){
        var textImage1 = document.getElementById("txt1").value;
    }

    if(document.getElementById("txt2")){
        var textImage2 = document.getElementById("txt2").value;
    }

    var memeTitle = document.getElementById("memeTitle").value;
    var memeDescription = document.getElementById("memeDescription").value;
    var memeCategory = document.getElementById("memeCategory").value;

    var data = "txt1="+textImage1+"&txt2="+textImage2+"&textColor1="+textColor1+"&textColor2="+textColor2+"&memeTitle="+memeTitle+"&memeDescription="+memeDescription+"&memeCategory="+memeCategory+"&currentImagePath="+currentImagePath;
    sendMemeAjax(data);
}

var txtNum = 0
var currentZoneTxt = '';
var textColor1 = '#000000';
var textColor2 = '#000000';


function CreateZoneTexte() {
    txtNum++;
    if (txtNum > 2){return;}
    /* for (i = 1; 2; i++) { */
    var divTexte = document.createElement("DIV");
/*     divTexte.setAttribute("draggable", "true");
 */    divTexte.setAttribute("class", "blocTextarea");
    var blocTexte = document.createElement("TEXTAREA");
    blocTexte.setAttribute("id", "txt" + txtNum);
    blocTexte.setAttribute("class", "bloctext" + txtNum);
    blocTexte.setAttribute("onfocus", "currentZoneTxt=this.id");

        //divTexte.setAttribute("ondragstart", "drag(event)");


    
    //// blocTexte.setAttribute("contenteditable", "true");
    var zoneImage = document.getElementById("zoneTextAlpha");
    zoneImage.appendChild(divTexte);
    divTexte.appendChild(blocTexte);
    //zoneImage.innerHTML("<div id='txt" + txtNum + "' class='bloctext' draggable='true' onclick='alert(this.id());'></div>");
    blocTexte.focus();
    /* } */
}

function ChangeColorTextPreview(){
    
    var textColor = document.getElementById("textColor").value;
    document.getElementById(currentZoneTxt).style.color = textColor;

    if(currentZoneTxt == 'txt1'){
        textColor1 = textColor;
    }
    if(currentZoneTxt == 'txt2'){
        textColor2 = textColor;
    }
}

function ZoneText(){
var wImg = document.getElementById('imgDisplay').offsetWidth;
var hImg = document.getElementById('imgDisplay').offsetHeight;

zoneTextAlpha.style.width = wImg +'px';
zoneTextAlpha.style.height = hImg +'px';

}

