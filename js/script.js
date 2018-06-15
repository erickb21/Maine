
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
        case 4: stateComplete(); break; // 4 (complete)	Données sont complètement accessibles
    }
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
    var tmp = ajaxrequest.responseText;//.split(":");
    //if (typeof (tmp[1]) != "undefined") {
    //    f.elements["string1_r"].value = tmp[1];
    //    f.elements["string2_r"].value = tmp[2];
    //}
    for (var i = 0; i < tmp.length; i++) {
        //alert("stateUninitialized" + tmp[i]);
    }
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
