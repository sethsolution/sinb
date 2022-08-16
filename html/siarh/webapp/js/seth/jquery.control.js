var num_ban;
$(document).ready(function (){
    /**
    Validación de numeros
    **/
    $('.num_decimalNegativo').off("keypress").on("keypress",function(event) {
        return control_decimalNegativo(event,this.value);
    }).on("keyup",function(){
        //this.value = control_valor(this.value);
    }).on("click",function(event) {
        valor = this.value;
        valor = valor.replace(",",".");
        if(valor==0){
            this.value = "";
        }
    });
    /**
    Numeros decimales con mascara
    **/
    $('.num_decimal').off("keypress").on("keypress",function(event) {
        return control_decimal(event,this.value);
    }).on("keyup",function(){
        //this.value = control_valor(this.value);
    }).on("click",function(event) {
        valor = this.value;
        valor = valor.replace(",",".");
        if(valor==0){
            this.value = "";
        }
    }).mask("#.##0,00", {reverse: true});
    /**
    Numeros decimales con mascara para 3 decimales
    **/
    $('.num_decimal3').off("keypress").on("keypress",function(event) {
        return control_decimal(event,this.value);
    }).on("keyup",function(){
        //this.value = control_valor(this.value);
    }).on("click",function(event) {
        valor = this.value;
        valor = valor.replace(",",".");
        if(valor==0){
            this.value = "";
        }
    }).mask("#.##0,000", {reverse: true});
    /**
    Números decimales sin mascara
    **/
    $('.num_decimal2').off("keypress").on("keypress",function(event) {
        return control_decimal(event,this.value);
    }).on("keyup",function(){
        //console.log("entro al keyup 4");
        this.value = control_valor(this.value);
    }).on("click",function(event) {
        //console.log("entro al click 2");
        //valor = parseInt(this.value);
        valor = this.value;
        if(valor==0){
            this.value = "";
        }
    });
    

    $('.num_entero').off("keypress").on("keypress",function(event) {
        return control_entero(event,this.value)
    }).on("keyup",function(){
        //console.log("entro al keyup 1 Entero");
        this.value = control_valor(this.value);
    }).on("click",function(event) {
        //console.log("entro al click 1 Entero");
        valor = parseInt(this.value);
        if(valor==0){
            this.value = "";
        }
    }).mask("#.##0",{reverse: true});
    
    
    $('.num_entero2').off("keypress").on("keypress",function(event) {
        return control_entero(event,this.value)
    }).on("keyup",function(){
        this.value = control_valor(this.value);
    }).on("click",function(event) {
        valor = parseInt(this.value);
        if(valor==0){
            this.value = "";
        }
    });
    
    $('.num_100').off("keypress").on("keypress",function(event) {
        num_ban = this.value;
        return control_entero(event,this.value)
    }).on("keyup",function(){
        this.value = control_valor(this.value);
        if(this.value>100){
            this.value = num_ban;
        }
    }).on("click",function(event) {
        valor = parseInt(this.value);
        if(valor==0){
            this.value = "";
        }
    });
    
});

function control_valor(dato){
    //console.log("entro a control_valor");
    valor = dato;
        if(valor.length != 1){
            if(valor[0]==0){
                valor = valor.substr(1);
                if(valor[0]=='.'){
                    valor = valor.substr(1);
                }
                if(valor[0]==','){
                    valor = valor.substr(1);
                }
            }
        }
    return valor;
}

function control_entero(evt,valor){
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

function control_decimal(evt,valor){
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }

    value = valor.replace(/\./g,"");    
    value = value.replace(",",".");
    value = parseInt(value);
    
    //console.log("valor:"+value);
    //console.log("key:"+keynum);
    /*
    
    console.log("Value:"+value);
    console.log("key:"+keynum);
    console.log("-----------");
    */
    
    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==46 || keynum==0){
        /*
        if(keynum!=0 && keynum!=8 && value <= 0  && !isNaN(value) ){
            console.log("Falso");
            return false;
        }else{
        */
            //console.log("verdadero");
            if(keynum==46){
                //console.log("entro a expresion");
                regexp2 = /^[0-9]+$/ 
                return (regexp2.test(value) ) 
            }else{
                //console.log("NO entro a expresion");
            }
        /*
        }
        */
    
    }else{
        return false;
    }
}
function control_decimalNegativo(evt,value){
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
function control_decimalNegativo2(evt,valor){
    
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    console.log("Tecla: "+keynum);
    value = valor.replace(/\./g,"");    
    value = value.replace(",",".");
    //value = parseInt(value);
    value = parseFloat(value);
    console.log("valor:"+value);

    /*
    
    console.log("Value:"+value);
    console.log("key:"+keynum);
    console.log("-----------");
    */
    
    //comprobamos si se encuentra en el rango
    if( ( keynum>47 && keynum<58) || keynum==8 || keynum==46 || keynum==0 || keynum==45){
        
        //if(keynum!=0 && keynum!=8 && value <= 0  && !isNaN(value) ){
        if(keynum!=0 && keynum!=8 && value == 0  && !isNaN(value) ){
            console.log("Falso");
            console.log("value:"+value);
            return false;
        }else{
            
            console.log("verdadero");
            console.log("value:"+value);
            
            if(keynum==46){
                //console.log("entro a expresion");
                regexp2 = /^[0-9]+$/ 
                return (regexp2.test(value) ) 
            }else{
                //console.log("NO entro a expresion");
            }
        }
    
    }else{
        return false;
    }
}