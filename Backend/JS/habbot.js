function habilitar_botonsimp(value){
	if(value==false){
		document.getElementById("cantsimp").disabled=true;
		$("#cantsimp").val(0);
	}
	else if(value==true){
		document.getElementById("cantsimp").disabled=false;
		$("#cantsimp").val(0);
	}
}
function habilitar_botonmat(value){
	if(value==false){
		document.getElementById("cantmat").disabled=true;
		$("#cantmat").val(0);
	}
	else if(value==true){
		document.getElementById("cantmat").disabled=false;
		$("#cantmat").val(0);
	}
}
function habilitar_botontwin(value){
	if(value==false){
		document.getElementById("canttwin").disabled=true;
		$("#canttwin").val(0);
	}
	else if(value==true){
		document.getElementById("canttwin").disabled=false;
		$("#canttwin").val(0);
	}
}
function habilitar_botontri(value){
	if(value==false){
		document.getElementById("canttri").disabled=true;
		$("#canttri").val(0);
	}
	else if(value==true){
		document.getElementById("canttri").disabled=false;
		$("#canttri").val(0);
	}
}