{literal}
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=myMap" async defer></script>
<script>
    function myMap() {
        var lati = document.getElementById("latitud").value;
        var longi = document.getElementById("longitud").value;
        
        if(lati=="" || longi=="")
        {
            lati="-16.495740899999998";
            longi="-68.13348389999999";
        }
        var myCenter = new google.maps.LatLng(lati,longi);
        var mapCanvas = document.getElementById("googleMap");
        var mapOptions = {center: myCenter, zoom: 17,mapTypeId: 'roadmap'};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter,draggable: true,title: 'Arrástrame!!'});
        marker.setMap(map);

        var input = document.getElementById('mapsearch');
        var searchBox = new google.maps.places.SearchBox(input);

        buscar(searchBox,map,marker);
        drag(marker);

        google.maps.event.addListener(map, 'click', function(event) {
            marker.setMap(null);
            marker = new google.maps.Marker({
                position: event.latLng, 
                map: map,
                draggable: true
            });
            //marker.setMap(map);
            currentLatitude = event.latLng.lat()
            currentLongitude = event.latLng.lng()
            document.getElementById("latitud").value = currentLatitude;
            document.getElementById("longitud").value = currentLongitude;
            drag(marker);
        });

    }
    function buscar(searchBox, map, marker){
        google.maps.event.addListener(searchBox, 'places_changed',function(){
            var places = searchBox.getPlaces();

            var bounds = new google.maps.LatLngBounds();
            var i, place;

            for(i=0; place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }
            map.fitBounds(bounds);
            map.setZoom(15);
        });
    }

    function drag(marker){
        google.maps.event.addListener(marker, 'dragend', function(marker){
            
            currentLatitude = marker.latLng.lat();
            currentLongitude = marker.latLng.lng();
            document.getElementById("latitud").value = currentLatitude;
            document.getElementById("longitud").value = currentLongitude;
        });
    }

</script>
<script>
    var snippet_general_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form');
        var general_btn_submit = $('#general_submit');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                console.log("test: "+responseText.accion);
                if(responseText.accion =='update') {
                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                    //console.log("Actualizó : "+responseText.id);
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
                    console.log("es nuevo : "+responseText.id);
                }
            }else if(responseText.res ==2){
                swal("Ocurrio un error!", responseText.msg, "error")
            }else{
                swal("ocurrio un error!", responseText.msg, "danger")
            }
        };

        var options = {
            beforeSubmit:showRequest
            , dataType: 'json'
            , success:  showResponse
            , data: {
                accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                ,itemId:idficha
                ,type:type

            }
        };
        var handle_form_submit=function(){
            general_form.ajaxForm(options);
        };

        var handle_general_form_submit = function() {

            general_btn_submit.click(function(e) {
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                if (!form.valid()) {
                    return;
                }
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });
        };


        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_form_submit();
                handle_form_submit();
                handle_general_components();
            }
        };
    }();

    var snippet_avatar = function(){
        var idficha = '{/literal}{$id}{literal}';
        var form_modal = $('#form_avatar');
        var form_btn_submit = $('#form_avatar_submit');
        var avatar_src= '{/literal}{$getModule}&accion=foto.get&id={$id}&type=3{literal}';
        //console.log("entro");
        var showRequest= function(formData, jqForm, op) {
            form_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };

        var showResponse = function (responseText, statusText) {
            //console.log("termino el proceso");
            form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                $('#input_archivo_avatar').val("");
                $('#input_archivo_avatar').next('.custom-file-label').html("");
                d = new Date();
                $('#persona_avatar').attr("src",avatar_src+"&"+d.getTime());
                //console.log(responseText);
                if(responseText.res =='1') {
                    swal({type: 'success',title: 'Buen Trabajo! Se a creado el registro con exito!',showConfirmButton: false,timer: 1000});
                }else{
                    swal("Ocurrio un error!", responseText.msg, "error");
                }
            }

        };

        var options = {
            beforeSubmit:showRequest
            , dataType: 'json'
            , success:  showResponse
            , data: {
                accion:'{/literal}avatar.updatesql{literal}'
                ,itemId:idficha
            }
        };
        var handle_form_modal_submit=function(){
            form_modal.ajaxForm(options);
        };

        var handle_form_modal_btn_submit = function() {
            form_btn_submit.click(function(e) {
                e.preventDefault();
                //var btn = $(this);
                var form = $(this).closest('form');
                if (!form.valid()) {
                    return;
                }
                form_modal.submit();
            });
        };

        var handle_form_modal_components = function(){
            $('#input_archivo_avatar').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("archivo").html(fileName);
                //console.log(fileName);
            });
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
        snippet_avatar.init();
    });

    

</script>
{/literal}