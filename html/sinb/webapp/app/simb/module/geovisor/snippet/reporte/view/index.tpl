{include file="index.css.tpl"}

{*<div class="card card-custo p-1 m-0" >*}
<div class=" card-custom gutter-b">
    <div class="row p-0">
        <div class="col-lg-12">
            <h4 class="titulo_esta">Proyectos por departamento</h4>
            <canvas id="chart_cantidad" width="auto" height="150"  ></canvas>
        </div>

        <div class="col-lg-12">
            <h4 class="titulo_esta">Proyectos por estado</h4>
            <canvas id="chart_monto_dos" width="auto" height="350"  ></canvas>
        </div>

        <div class="col-lg-12 d-none">
            <h4 class="titulo_esta">Tipo de fuente de generación</h4>
            <canvas id="chart_gd_tipo_fuente_generacion" width="auto" height="350"  ></canvas>
        </div>
    </div>
</div>


{include file="index.js.tpl"}