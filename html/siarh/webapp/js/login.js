var postData = "";
var alertInit = false;
var loginContainerInit = false;
var style_1;
var boxyLoading;

var loadingImg = "images/loading/rel_interstitial_loading.gif";

$(function(){
	boxyLoading = new Boxy(
	   "<div style='width:400px;padding:0px;' id='conteLoading'>"+
       "<img src='"+loadingImg+"'></div>",
        {
            title:"Procesando..."
            ,   modal: true
            ,   fixed:false
            ,   draggable:false
            ,   show:false
            ,   afterShow: function() {}
            ,   closeable:false
        });
});

function preloadImages(){
    var img = new Array(2);
    img[0] = new Image();
    img[0].src = loadingImg;
}

function boxyLoadingShow(){
	html = "<div class='msgbox-wrapper msgbox-alert' style='height: auto; min-height: 80px;'>"+ 
            "<img src=\""+loadingImg+"\"/>"+
            "<br /> Procesando datos..."+
            "</div>";
	$("#conteLoading").html(html);
	boxyLoading.show();
}
					   
function sendData(){
	colorbg="#fffcb5";
	colorbg2="#ffffff";
	$("#user").css('background',colorbg2);
	$("#password").css('background',colorbg2);
	$("#errormsg").hide();
    estadoe = $("#errormsg").css("visibility");
    if(estadoe == "hidden"){$("#errormsg").css("visibility","visible");}
    
	if ($("#user").attr("value")==""){
		$("#user").css('background',colorbg);       
		$("#errormsg").html("Ingrese su nombre de usuario");
		$("#errormsg").show();		
        $("#user").focus();
	}else if ($("#password").attr("value")==""){
		$("#password").css('background',colorbg);
		$("#errormsg").html("Ingrese su contrase&ntilde;a");
		$("#errormsg").show();
        $("#password").focus();
	}else{
		boxyLoadingShow();
		randomnumber=Math.floor(Math.random()*11);
		$.post("index.php",{action:"login",
						random:randomnumber,
						"user":$("#user").attr("value"),
						"password":hex_md5($("#password").attr("value"))
						}, function(data){
							verifyLogin(data);					
		});
	}
	
}

function verifyLogin(resp){
	if (resp == 1){
		$("#password").attr("value","");
        $("#password").focus();
		html = "<div class='msgbox-wrapper msgbox-alert' style='height: auto; min-height: 80px;'>"+
                "Los datos enviados de autentificaci&oacute;n son incorrectos, intente nuevamente"+
                "</div>";
		html += "<div class='areaboton'><div class='msgbox-buttons'>"+
                "<input type='button' id='cerrar01' class='submit' name='cerrar' value=' Cerrar ' onclick='$(\"#password\").focus();;boxyLoading.hide();'>"+
                "</div></div>";
		
		$("#conteLoading").html(html);
        $("#cerrar01").focus();
	}else if (resp == 0){
		boxyLoading.hide();
		$("#loginPage").slideUp("slow",function() {location="index.php";});
	}
}

preloadImages();