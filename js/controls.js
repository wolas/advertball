
var accettato=false;

function accetta(){
	accettato=true;
}

// Removes leading whitespaces
   function LTrim( value ) {
  	var re = /\s*((\S+\s*)*)/;
  	return value.replace(re, "$1");
}
     
// Removes ending whitespaces
function RTrim( value ) {
	var re = /((\s*\S+)*)\s*/;
	return value.replace(re, "$1");
}

// Removes leading and ending whitespaces
function trim( value ) {
	return LTrim(RTrim(value));
}

	function form_email(){
	var find_result;
	var str=document.invia_messaggio.email.value;
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(str)){
		find_result=true;
	}else{
		alert("Inserisci un indirizzo email corretto!");
		find_result=false;
	}
	return (find_result)
}


	function verificaDati(){
		var invio = "true";
		var s = trim(document.invia_messaggio.nome.value);
		if(s==""){
			alert("Inserisci il tuo nome!");
			invio = "false";
			document.invia_messaggio.nome.focus();
		}
		
		s = trim(document.invia_messaggio.cognome.value);
		if(s=="" && invio=="true"){
			alert("Inserisci il tuo cognome!");
			invio = "false";
			document.invia_messaggio.cognome.focus();
		}
		
		s = trim(document.invia_messaggio.email.value);
		if(s=="" && invio=="true"){
			alert("Inserisci il tuo indirizzo email!");
			invio = "false";
			document.invia_messaggio.email.focus();
		}else if(invio=="true"){
			if(form_email() == false)
				invio = "false";
				document.invia_messaggio.email.focus();
		}
		
		
		s = trim(document.invia_messaggio.messaggio.value);
		if(s=="" & invio=="true"){
			alert("Inserisci il tuo messaggio!");
			invio = "false";
			document.invia_messaggio.messaggio.focus();
		}
		
		if(accettato == false & invio=="true"){
			alert("Devi prendere visione dell'informativa sulla privacy cliccando sul link corrispondente");
			invio = "false";
		}
		
		if(invio=="true")
			document.invia_messaggio.submit();
	}
