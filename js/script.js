
var ajaxrequest = new XMLHttpRequest();
var data;
var traitement = "";
addListeFilms();


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
        document.getElementById("listfilms").innerHTML = "";
        //alert(lstnm);
        for (var i = 0; i < lstnm.length; i++) {
            var infosFilm = lstnm[i].split(":");
            var listeDeFilms = document.createElement("OPTION");
            listeDeFilms.setAttribute("value", infosFilm[1]);
            listeDeFilms.setAttribute("data-idfilm", infosFilm[0]);
            //listeDeFilms.setAttribute("onclick", "alert('text=' + this.id);");
            document.getElementById("listfilms").appendChild(listeDeFilms);
            //alert(infosFilm[0]);
        }
        //*******************
        var monbouton = document.getElementById("SearchButton");
        //alert("nbelem = " + document.getElementById("listfilms").options.length);
        
        if (document.getElementById("listfilms").options.length <= 2) {window.focus();};

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

function addListeFilms() {
    //alert("addliste");
    //var divSearchFilm = document.createElement("DIV");
    //divSearchFilm.setAttribute("id", "searchzone");
    //divSearchFilm.setAttribute("class", "searchzone");
    //document.getElementById("formFilmSearch").appendChild(divSearchFilm);


    var rechercheFilm = document.createElement("INPUT");
    rechercheFilm.setAttribute("id", "search");
    rechercheFilm.setAttribute("type", "search");
    rechercheFilm.setAttribute("required","");
    rechercheFilm.setAttribute("list", "listfilms");
    rechercheFilm.setAttribute("placeholder", "rechercher un film");
    rechercheFilm.setAttribute("onkeyup", "autocompletion(this.value);");

    document.getElementById("searchzone").appendChild(rechercheFilm);
    var inhtm = document.getElementById("searchzone").innerHTML;
    document.getElementById("searchzone").innerHTML = inhtm + '<label class="label-icon" for="search"><i id="SearchButton" onclick="chercheInfos();" class="material-icons">search</i></label><i class="material-icons" onclick="clearSearh();" >close</i>';
 
    var dataListeFilms = document.createElement("DATALIST");
    dataListeFilms.setAttribute("id", "listfilms");
    document.getElementById("searchzone").appendChild(dataListeFilms);

    var listeDeFilms = document.createElement("OPTION");
    listeDeFilms.setAttribute("value", "");
    listeDeFilms.setAttribute("data-idfilm", "");
    document.getElementById("listfilms").appendChild(listeDeFilms);
}

function clearSearh() {
    document.getElementById("search").value = ""
    document.getElementById("listfilms").innerHTML=""
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
    var selectionFilm = document.getElementById("listfilms");//document.getElementById("search").value;

    //alert("id du film sélectionné " + selectionFilm.options[0].dataset.idfilm);
    var filmId = "film/" + selectionFilm.options[0].dataset.idfilm;
    //alert("chemin : " + filmId);
    window.location = filmId;
    //return;
    //data = "infos=" + selectionFilm.options[0].id;//+ "%";
    //traitement = "getInfos";
    //requestajax(data);
    
    return true
};
