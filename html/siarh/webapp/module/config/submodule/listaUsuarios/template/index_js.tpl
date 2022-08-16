{literal}<script>
$(document).ready(function() {
	boxyLoadingShow();
	setTimeout(function() {
		boxyLoading.hide(); 
	}, 500 ); 
    
    iniciarUser('{/literal}{$getModule}{literal}');
    getTabla();
    
    $( "#tipousers" ).change(function() {
		boxyLoadingShow();	
        user_oTable.fnDraw();
    });   
});//END DOCUMENT READY
</script>{/literal}