var boxyLoading;
var loadingImg = "images/loading/loading03.gif";
htmlLoading = "<center>Cargando Datos... <br/><img src='"+loadingImg+"'></center>";

function verWin(url,width,height){
	boxyWindows = new Boxy("<iframe scrolling='no' frameborder='0' border='no' marginwidth='0' marginheight='0' width='"+width+"px' height='"+height+"px' scroll='no' src='"+url+"'>",
					{title:"Windows", modal: true,fixed:false,
					draggable:false,show:false,afterShow: function() {
						//setTimeout("updateMapDataDealer()",2000);
						//loadingSideBar();
   					},closeable:true,unloadOnHide:true});
	boxyWindows.show();
}

function boxyLoadingShow(){
	html = "<center>&nbsp;&nbsp;&nbsp;&nbsp; Se est&aacute procesando su acci&oacute;n &nbsp;&nbsp;&nbsp;&nbsp;<br /><img src=\""+loadingImg+"\"/></center><br/>";
	boxyLoading = new Boxy(html,
					{title:"Procesando ... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", modal: true,fixed:false,
					draggable:false,show:false,afterShow: function() {
						//
   					},closeable:false,unloadOnHide:true});
	boxyLoading.show();
}

function iframeBox(url,w,h){
	
    frameFormIte =  "<iframe src=\""+url+"\" frameborder=\"0\" ";
    frameFormIte += "width=\""+w+"\" height=\""+h+"\" marginheight=\"0\" marginwidth=\"0\" ";
    frameFormIte += " name=\"cateFormBoxy\" scrolling=\"auto\" id=\"cateFormBoxy\"></iframe>";
    
    return frameFormIte
}

function Comparar_Fecha(String1,String2){
	anyo1=String1.substring(0,4);
	mes1=String1.substring(5,7);
	dia1=String1.substring(8,10);
    hora1 = String1.substring(11,13);
    minuto1 = String1.substring(14,16);
    segundo1 = String1.substring(17,19);
	anyo2=String2.substring(0,4);
	mes2=String2.substring(5,7);
	dia2=String2.substring(8,11);
    hora2 = String2.substring(11,13);
    minuto2 = String2.substring(14,16);
    segundo2 = String2.substring(17,19);
	if (dia1 == "08") // parseInt("08") == 10 base octogonal
	dia1 = "8";
	if (dia1 == '09') // parseInt("09") == 11 base octogonal
	dia1 = "9";
	if (mes1 == "08") // parseInt("08") == 10 base octogonal
	mes1 = "8";
	if (mes1 == "09") // parseInt("09") == 11 base octogonal
	mes1 = "9";
	if (dia2 == "08") // parseInt("08") == 10 base octogonal
	dia2 = "8";
	if (dia2 == '09') // parseInt("09") == 11 base octogonal
	dia2 = "9";
	if (mes2 == "08") // parseInt("08") == 10 base octogonal
	mes2 = "8";
	if (mes2 == "09") // parseInt("09") == 11 base octogonal
	mes2 = "9";
	
    segundo1=parseInt(segundo1);
    segundo2=parseInt(segundo2);
    minuto1=parseInt(minuto1);
    minuto2=parseInt(minuto2);
    hora1=parseInt(hora1);
    hora2=parseInt(hora2);
    dia1=parseInt(dia1);
	dia2=parseInt(dia2);
	mes1=parseInt(mes1);
	mes2=parseInt(mes2);
	anyo1=parseInt(anyo1);
	anyo2=parseInt(anyo2);
	
    if (anyo1>anyo2){
		return false;
	}
	if ((anyo1==anyo2) && (mes1>mes2)){
		return false;
	}
	if ((anyo1==anyo2) && (mes1==mes2) && (dia1>dia2)){
		return false;
	}
    if ((anyo1==anyo2) && (mes1==mes2) && (dia1==dia2) && (hora1>hora2)){
		return false;
	}
    if ((anyo1==anyo2) && (mes1==mes2) && (dia1==dia2) && (hora1==hora2) && (minuto1>minuto2)){
		return false;
	}  
	return true;
}

function comparaFecha(fecha,fecha2){
    var fechaIni = fecha.split("-");
    var fechaFin = fecha2.split("-");
    if(parseInt(fechaIni[2],10)>parseInt(fechaFin[2],10)){
        return(true);
    }else{
        if(parseInt(fechaIni[2],10)==parseInt(fechaFin[2],10)){
            if(parseInt(fechaIni[1],10)>parseInt(fechaFin[1],10)){
                return(true);
            }
            if(parseInt(fechaIni[1],10)==parseInt(fechaFin[1],10)){
                if(parseInt(fechaIni[0],10)>parseInt(fechaFin[0],10)){
                    return(true);
                }else{
                    return(false);
                }
            }else{
                return(false);
            }
        }else{
            return(false);
        }
    }
}

function soloNumerosValido(evt,valor){
    //valor = obj.value;
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==0 ){
        if(valor != '' && keynum!=0 && keynum!=8 && valor == 0){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}
/**
    Verifica si es un numero entero real
**/
function soloNumeros(evt){
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }

    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==0 || keynum==118){
        return true;
    }else{
        return false;
    }
}


function soloAlphanumericos(evt){
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    regx = /[A-Za-z��\s]/;
    //alert(keynum);
    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==0  || keynum==32 || keynum==45 || keynum==40
      || keynum==41  || keynum==47 || keynum==46 || keynum==44 || (keynum>64 && keynum<91) 
      || (keynum>96 && keynum<123) || keynum==209 || keynum==241 || keynum==225 || keynum==233 || keynum==237 
      || keynum==243 || keynum==250 || keynum==193 || keynum==201 || keynum==205 || keynum==211 || keynum==218
      || keynum==13 || keynum==58 || keynum==64 || keynum==118
      ){
        return true;
    }else{
        if((regx.test(keynum)))
        {    
            return true;
        }else{
            
            return false;
        }
        
    }
}

function soloNumerosMasdeUnPunto(evt,value){
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE

        keynum = evt.keyCode;
    }else{

        keynum = evt.which;

    }
    //alert(keynum);
    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==46 || keynum==0){
        return true; 
   }else{
        return false;
    }

}
function soloNumerosPuntoNegativo(evt,value){
    //asignamos el valor de la tecla a keynum
    
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    //alert("hola2: "+keynum+" "+value);
      //comprobamos si se encuentra en el rango
    if( (keynum>47 && keynum<58) 
        || keynum==8 
        || keynum==46 
        || keynum==0 
        || keynum==45){
        
        if(keynum==46 || keynum==45 ){
            if(keynum==45 && value==""){
                return true;
            }else{
                //regx=/^-{0,1}\d*\.{0,1}\d+$/
                //  regx = /^\-\?\d*\.{0,1}\d+$/ 
                //  regx=/^(\+|-)?([0-9]+(\.[0-9]+))$/
                //  regx=/^\-?\d{2}(\.(\d)*)?$/g;
                
                //if((/[.]\d*/.test(value)))
                //    return false;
                //if((/[.]\d*/.test(value)))
                //    return false;
                //else  
                //return (regx.test(value) )
                return true;
            } 
    } 
     
  }else{
    return false;
  }
}

function soloNumerosPunto(evt,valor){
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    
    value = valor.replace(/\./g,"");    
    value = value.replace(",",".");
    value = parseInt(value);

    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==46 || keynum==0){
        
        if(keynum!=0 && keynum!=8 && value <= 0  && !isNaN(value) ){

            return false;
        }else{

            if(keynum==46){

                regexp2 = /^[0-9]+$/ 
                return (regexp2.test(value) ) 
            }else{

            }
        }
    
    }else{
        return false;
    }
}


function disallowSpace(evt){
    if(window.event){
        keyspace = evt.keyCode;
    }else{
        keyspace = evt.which;
    }
    if( keyspace == 32 ){
        return false;
    }else{
        return true;
    } 
    
}


function number_format (number, decimals, dec_point, thousands_sep) {
  // http://kevin.vanzonneveld.net
  // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +     bugfix by: Michael White (http://getsprink.com)
  // +     bugfix by: Benjamin Lupton
  // +     bugfix by: Allan Jensen (http://www.winternet.no)
  // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // +     bugfix by: Howard Yeend
  // +    revised by: Luke Smith (http://lucassmith.name)
  // +     bugfix by: Diogo Resende
  // +     bugfix by: Rival
  // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
  // +   improved by: davook
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +      input by: Jay Klehr
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +      input by: Amir Habibi (http://www.residence-mixte.com/)
  // +     bugfix by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Theriault
  // +      input by: Amirouche
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: number_format(1234.56);
  // *     returns 1: '1,235'
  // *     example 2: number_format(1234.56, 2, ',', ' ');
  // *     returns 2: '1 234,56'
  // *     example 3: number_format(1234.5678, 2, '.', '');
  // *     returns 3: '1234.57'
  // *     example 4: number_format(67, 2, ',', '.');
  // *     returns 4: '67,00'
  // *     example 5: number_format(1000);
  // *     returns 5: '1,000'
  // *     example 6: number_format(67.311, 2);
  // *     returns 6: '67.31'
  // *     example 7: number_format(1000.55, 1);
  // *     returns 7: '1,000.6'
  // *     example 8: number_format(67000, 5, ',', '.');
  // *     returns 8: '67.000,00000'
  // *     example 9: number_format(0.9, 0);
  // *     returns 9: '1'
  // *    example 10: number_format('1.20', 2);
  // *    returns 10: '1.20'
  // *    example 11: number_format('1.20', 4);
  // *    returns 11: '1.2000'
  // *    example 12: number_format('1.2000', 3);
  // *    returns 12: '1.200'
  // *    example 13: number_format('1 000,50', 2, '.', ' ');
  // *    returns 13: '100 050.00'
  // Strip all characters but numerical ones.
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

function printTools(prints){//DTTT_container       printGraficoTodo
  
 var texImpr=$("#"+prints);
 if (texImpr.size() > 1){
  texImpr.eq( 0 ).print();
        return;
 } else if (!texImpr.size()){
         return;
 }
 
 var strFrameName = ("printer-" + (new Date()).getTime());
    var jFrame = $( "<iframe name='" + strFrameName + "'>" );
    jFrame
            .css( "width", "1px" )
            .css( "height", "1px" )
            .css( "position", "absolute" )
            .css( "left", "-9999px" )
            .appendTo( $( "body:first" ) )
    ;
    var objFrame = window.frames[ strFrameName ];
    var objDoc = objFrame.document;
    
    var Divs = $( "<div>" ).append($( "style" ).clone());
    objDoc.open();
    objDoc.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
    objDoc.write( "<html>" );
    objDoc.write( "<body>" );
    objDoc.write( "<head>" );
    objDoc.write( "<title>" );
    objDoc.write( document.title );
    objDoc.write( "</title>" );
    objDoc.write( Divs.html() );
    objDoc.write( "</head>" );
    objDoc.write( texImpr.html() );
    objDoc.write( "</body>" );
    objDoc.write( "</html>" );
    
    objDoc.close();
    

    objFrame.focus();
    objFrame.print();

    setTimeout(
    function(){
            jFrame.remove();
    },
    (60 * 1000)
    );
    $("#documentHeader").css("display","none");
 $("#documentFooter").css("display","none");
    
}
   