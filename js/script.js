function MM_findObj(n, d) { 
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_showHideLayers() { 
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
    obj.visibility=v; }
}

function showBox(number)
{
	hideBox(number);
	MM_showHideLayers('box'+number,'','show');
	document.getElementById('prod_'+number).className='prodottoon';
	//document.getElementById('label'+number).src='res/img/label'+number+'_on.gif';
}

function hideBox(number)
{
	var elements=document.getElementsByTagName("div");
    for (var i=0;i<elements.length ;i++ ){
    	var currentElement = elements[i];
        var id = currentElement.id;
		if(id.match('prod_') != null && id.match('prod_') != "null"){
			currentElement.className='prodottooff';
			var indice = id.substr(5);
			//document.getElementById('label'+indice).src='res/img/label'+indice+'_off.gif';
			MM_showHideLayers('box'+indice,'','hide');
		}
    }
}

function showBallon(number)
	{
		MM_showHideLayers('ballon'+number,'','show');
	}

function hideBallon(number)
	{
		MM_showHideLayers('ballon'+number,'','hide');
	}
	
function showDesc(number)
	{
		MM_showHideLayers('descnegozio'+number,'','show');
	}

function hideDesc(number)
	{
		MM_showHideLayers('descnegozio'+number,'','hide');
	}
	
function conta(){
var lenMax=250
var strlength=document.invia_messaggio.messaggio.value.length
total = eval("250")
char = eval(document.invia_messaggio.messaggio.value.length)
left = eval(total - char)
if (left <= "-1")
{
var dif = eval(char - 250)
var value = document.invia_messaggio.messaggio.value.substr(0,char-dif);
document.invia_messaggio.messaggio.value = value;
var left = "0"
}
document.invia_messaggio.maxcarat.value=left
}