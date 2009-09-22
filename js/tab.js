/*Switch tab box home page*/

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

function showTab1()
{
	MM_showHideLayers('texttab1','','show');
	MM_showHideLayers('texttab2','','hide');
	MM_showHideLayers('texttab3','','hide');
	MM_showHideLayers('texttab4','','hide');
	document.getElementById("tab1").className='on';
	document.getElementById("tab2").className='off';
	document.getElementById("tab3").className='off';
	document.getElementById("tab4").className='off';
}

function showTab2()
{
	MM_showHideLayers('texttab1','','hide');
	MM_showHideLayers('texttab2','','show');
	MM_showHideLayers('texttab3','','hide');
	MM_showHideLayers('texttab4','','hide');
	document.getElementById("tab1").className='off';
	document.getElementById("tab2").className='on';
	document.getElementById("tab3").className='off';
	document.getElementById("tab4").className='off';
}

function showTab3()
{
	MM_showHideLayers('texttab1','','hide');
	MM_showHideLayers('texttab2','','hide');
	MM_showHideLayers('texttab3','','show');
	MM_showHideLayers('texttab4','','hide');
	document.getElementById("tab1").className='off';
	document.getElementById("tab2").className='off';
	document.getElementById("tab3").className='on';
	document.getElementById("tab4").className='off';
}

function showTab4()
{
	MM_showHideLayers('texttab1','','hide');
	MM_showHideLayers('texttab2','','hide');
	MM_showHideLayers('texttab3','','hide');
	MM_showHideLayers('texttab4','','show');
	document.getElementById("tab1").className='off';
	document.getElementById("tab2").className='off';
	document.getElementById("tab3").className='off';
	document.getElementById("tab4").className='on';
}

// Show Hide layer
function showBox(number)
{
	MM_showHideLayers('texttab'+number,'','show');
}

function hideBox(number)
{
	MM_showHideLayers('texttab'+number,'','hide');
}