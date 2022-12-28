{literal}
<style>
	.contenedor {
		position: relative;
		display: block;
	    height: 100vh;
	    width: 100vw;
	}

	.contenedor_mapa {
		position: relative;
		display: block;
	    height: 100vh;
	    width: 65vw;
	    float: left;
	}

	.contenedor_estadistica {
		position: relative;
		background-color: #f5f5f5;
		display: block;
	    height: 100vh;
	    width: 35vw;
	    float: left;
	    overflow-y: auto;
		overflow-x: auto;
	}
	
	.estadistica_contenido {
	    padding-top: 15px;
	}

	.contenedor_filtros {
		position: absolute;
		display: block;
	    height: 100%;
	    width: 100%;
	    top: 0;
	    background: rgba(255, 255, 255, 0.7);
	    overflow-y: auto;
		overflow-x: auto;
		z-index: 10;
	}

	.mapa {
		position: fixed;
	    height: 100vh;
	    width: 65vw;
	}

	.panel_menu {
		position: absolute;
		display: block;
		width: auto;
		height: auto;
		z-index: 800;
		right: 0;
		padding-top: 12px;
		padding-right: 12px;
	}

	.panel {
		position: absolute;
		width: 380px;
		height: 100vh;
		z-index: 801;
		top: 0px;
		right: 0px;
		background: rgba(41, 43, 58, 0.7);
		overflow-x: hidden;
		overflow-y: auto;
	}

	.panel_header {
		position: absolute;
		width: 100%;
		background: rgba(40, 42, 60, 0.9);
		padding-top: 10px;
		padding-bottom: 10px;
		padding-left:10px;
		padding-right:10px;
		color: rgb(255, 184, 34);
		z-index: 5;
	}

	.btn_cerrar_panel {
		position: absolute;
		top: 0;
		right: 0;
		z-index: 6;
	}

	.panel_content {
		position: relative;
		width: 100%;
		height: auto;
		background: rgba(41, 43, 58, 0);
		padding-top: 60px;
		padding-bottom: 5px;
		padding-left: 10px;
		padding-right: 10px;
	}

	.control_capas {
		padding-top: 5px;
		padding-bottom: 5px
	}

	.marker-pin {
		width: 30px;
		height: 30px;
		border-radius: 50% 50% 50% 0;
		background: #c30b82;
		position: absolute;
		transform: rotate(-45deg);
		left: 50%;
		top: 50%;
		margin: -15px 0 0 -15px;
		border: 2px solid #ffffff;
	}

	.marker-pin::after {
	    content: '';
	    width: 11px;
	    height: 11px;
	    margin: 7px 0 0 7px;
	    background: #fff;
	    position: absolute;
	    border-radius: 50%;
	 }

	.div_icon_indice span {
		position: absolute;
		width: 22px;
		font-size: 22px;
		left: 0;
		right: 0;
		margin: 10px auto;
		text-align: center;
	}

	table.dataTable td.focus {
        box-shadow: #4acb98 0px 0px 2px 2px inset !important;
    }

    .marker-cluster-especies {
		background-color: rgba(255, 251, 128, 0.6) !important;
		background-clip: padding-box;
		border-radius: 20px;
	}

	.marker-cluster-especies div {
		background-color: rgba(220, 213, 0, 0.6) !important;
		width: 30px;
		height: 30px;
		margin-left: 5px;
		margin-top: 5px;
		text-align: center;
		border-radius: 15px;
		font: 12px "Helvetica Neue", Arial, Helvetica, sans-serif;
	}

	.marker-cluster-especies span {
		line-height: 30px;
	}

	.marker-cluster-especies-nativas {
		background-color: rgba(255, 153, 0, 0.6) !important;
		background-clip: padding-box;
		border-radius: 20px;
	}

	.marker-cluster-especies-nativas div {
		background-color: rgba(220, 213, 0, 0.6) !important;
		width: 30px;
		height: 30px;
		margin-left: 5px;
		margin-top: 5px;
		text-align: center;
		border-radius: 15px;
		font: 12px "Helvetica Neue", Arial, Helvetica, sans-serif;
	}

	.marker-cluster-especies-nativas span {
		line-height: 30px;
	}

    /*--BEGIN::MEDIA QUERY--*/
	@media(max-width: 480px) {
		.panel {
			height: 100%;
			width: 100%;
		}

		.contenedor_mapa {
			position: relative;
			display: block;
		    height: 480px;
		    width: 100%;
		    float: left;
		}

		.mapa {
			position: fixed;
		    height: 480px;
		    width: 100%;
		}

		.contenedor_estadistica {
			position: relative;
			background-color: #f5f5f5;
			display: block;
		    height: auto;
		    width: 100%;
		    float: left;
		    overflow-y: auto;
			overflow-x: hidden;
		}
	}

	@media(min-width: 481px) {
		.panel {
			height: 100%;
			width: 100%;
		}

		.contenedor_mapa {
			position: relative;
			display: block;
		    height: 480px;
		    width: 100%;
		    float: left;
		}

		.mapa {
			position: fixed;
		    height: 480px;
		    width: 100%;
		}

		.contenedor_estadistica {
			position: relative;
			background-color: #f5f5f5;
			display: block;
		    height: auto;
		    width: 100%;
		    float: left;
		    overflow-y: auto;
			overflow-x: hidden;
		}
	}

	@media(min-width: 768px) {
		.panel {
			height: 100%;
			width: 380px;
		}

		.contenedor_mapa {
			position: relative;
			display: block;
		    height: 480px;
		    width: 100%;
		    float: left;
		}

		.mapa {
			position: fixed;
		    height: 480px;
		    width: 100%;
		}

		.contenedor_estadistica {
			position: relative;
			background-color: #f5f5f5;
			display: block;
		    height: auto;
		    width: 100%;
		    float: left;
		    overflow-y: auto;
			overflow-x: hidden;
		}
	}

	@media(min-width: 992px) {
		.panel {
			height: 100vh;
			width: 380px;
		}

		.contenedor_mapa {
			position: relative;
			display: block;
		    height: 100vh;
		    width: 65vw;
		    float: left;
		}

		.mapa {
			position: fixed;
		    height: 100vh;
		    width: 65vw;
		}

		.contenedor_estadistica {
			position: relative;
			background-color: #f5f5f5;
			display: block;
		    height: 100vh;
		    width: 35vw;
		    float: left;
		    overflow-y: auto;
			overflow-x: hidden;
		}
	}

	@media(min-width:1200px){
		.panel {
			height: 100vh;
			width: 380px;
		}

		.contenedor_mapa {
			position: relative;
			display: block;
		    height: 100vh;
		    width: 65vw;
		    float: left;
		}

		.mapa {
			position: fixed;
		    height: 100vh;
		    width: 65vw;
		}

		.contenedor_estadistica {
			position: relative;
			background-color: #f5f5f5;
			display: block;
		    height: 100vh;
		    width: 35vw;
		    float: left;
		    overflow-y: auto;
			overflow-x: hidden;
		}
	}

	.select2 {
		width:100%!important;
	}

</style>
{/literal}