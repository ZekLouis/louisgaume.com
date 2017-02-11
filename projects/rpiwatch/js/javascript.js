var nombreOnglets = 5;
function changeOnglet(numero)
{
// On commence par tout masquer
for (var i = 0; i < nombreOnglets; i++){
	document.getElementById("contenuOnglet" + i).style.display = "none";
	document.getElementById("onglet" + i).className = '';

}
// Puis on affiche celui qui a été sélectionné
document.getElementById("contenuOnglet" + numero).style.display = "block";
document.getElementById("onglet" + numero).className = 'active';
}
 
 
//Pour charger + ou - de photos/vidéos sur le site
$(document).ready(function (){
	//télecharger les 3 premières photos
	$('#photos li:lt(3)').show();
	$('#loadMore1').click(function (){
		$('#photos li:lt(10)').show();
	});
	$('#showLess1').click(function (){
		$('#photos li').not(':lt(3)').hide();
	});
});	


$(document).ready(function (){
	//télecharger les 3 premières vidéos
	$('#videos li:lt(3)').show();
	$('#loadMore2').click(function (){
		$('#videos li:lt(10)').show();
	});
	$('#showLess2').click(function (){
		$('#videos li').not(':lt(3)').hide();
	});
});
// document.getElementById('retour').textContent = "Prise de la photo ... Démarrage de la détection";

			function launchDetect(){
			        $('#ajaxloader').show();
			        var xhttp = new XMLHttpRequest();
			        xhttp.open("GET", "cgi-bin/raspiwatch.cgi?on=Démarrer&duree=5",true);
			        xhttp.send();
			        setTimeout(function(){$('#ajaxloader').hide();},3000);
}

function stopDetect(){
        $('#ajaxloader').show();
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "cgi-bin/raspiwatch.cgi?off=Arrêter&duree=5",true);
        xhttp.send();
        setTimeout(function(){$('#ajaxloader').hide();},3000);
}

function takePhoto(){
        $('#ajaxloader').show();
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "cgi-bin/raspiwatch.cgi?photo=Photo",true);      
        xhttp.send();
        setTimeout(function(){$('#ajaxloader').hide();},2500);                                                                                                                        
}

function takeVideo(){
	var duree = document.getElementById("duree").value;
	if(duree > 60 || duree < 1){
		alert("la durée de la vidéo doit être comprise entre 1 et 60 secondes");
	}
	else{
		$('#ajaxloader').show(); 
		var xhttp = new XMLHttpRequest();
		xhttp.open("GET", "cgi-bin/raspiwatch.cgi?video=Vidéo&duree="+duree,true);
		xhttp.send();
		setTimeout(function(){$('#ajaxloader').hide();},duree*1000+3000);
        }                                                                                                                        
}

function changerConfig(){
        $('#ajaxloader').show();
        var xhttp = new XMLHttpRequest();
        var resolution = $('input[name=res]:checked').val(); 
        var ips = $('input[name=ips]:checked').val();
        var seuil = document.getElementById("seuil").value; 
        var lumi = document.getElementById("lum").value;
        xhttp.open("GET", "cgi-bin/raspiwatch.cgi?res=" + resolution + "&ips=" + ips + "&seuil=" + seuil + "&lum=" + lumi + "&submit=Valider",true);
        xhttp.send();
        setTimeout(function(){$('#ajaxloader').hide();},2000);
}

function actualiserEtat(){
        $('#etat').load('./php/etatDetec.php');
        
}

function actualiserLog(){
		$('#retour').load('./php/log.php');
}

function actualiserIPS(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
                if(xhttp.readyState == 4 && xhttp.status == 200) {
                       $('input[name=ips][value='+xhttp.responseText+']').prop("checked",true);
                }
        }
        xhttp.open("GET", "php/configIPS.php", true);
        xhttp.send();
}

function actualiserRes(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
                if(xhttp.readyState == 4 && xhttp.status == 200) {
                        $('input[name=res][value='+xhttp.responseText+']').prop("checked",true);
                }
        }
        xhttp.open("GET", "php/configRes.php", true);
        xhttp.send();
}

function actualiserBouton(){
        $('#ctrl form').load('./php/bouton.php');
}

function init(){
        $('#ajaxloader').hide();
        document.getElementById('AfficheRange2').textContent=document.getElementById('lum').value;
        document.getElementById('AfficheRange1').textContent=document.getElementById('seuil').value;
        actualiserIPS();
        actualiserRes();
        setInterval(function(){actualiserLog();}, 2000);
        setInterval(function(){actualiserEtat();},2000);
        setInterval(function(){actualiserBouton();},2000);
} 

$("#photos li,#videos li,#photosDetect li").hover(function(){
        $(this).children(".lienSupprimer").css("display","block");
        },function(){
        $(this).children(".lienSupprimer").css("display","none");
        
});

        
function supprPhoto(nom)
{
        if(confirm("Supprimer "+nom+" ?"))
        {
        
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET" , "cgi-bin/raspiwatch.cgi?delphoto="+nom, true);
                xhttp.send(); 
                $("#photos li:contains('"+nom+"'),#photosDetect li:contains('"+nom+"')").remove();
        }
}

function supprVideo(nom)
{
        if(confirm("Supprimer "+nom+" ?"))
        {
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", "cgi-bin/raspiwatch.cgi?delvideo="+nom, true);
                xhttp.send();
                $("#videos li:contains('"+nom+"')").remove();
        }
}