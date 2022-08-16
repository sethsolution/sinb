<div style="font-size: 13px;margin-bottom: 19px;width: 100%;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;">

    <div style="margin-right: 40px; margin-left: 40px; margin-top: 10px;">
        <div style="text-align: center;">
            <h2 style="margin: 0px;">Observaciones en la solicitud de MARCA VICUÑA</h2>
        </div>

        Se ha revisado su solicitud de Marca Vicuña y tiene observaciones
        que debe corregir para que su solicitud sea aprobado en el sistema CITES BOLIVIA.
        <br><br>
        Para poder corregir las observaciones, debe ingresar al sistema CITES, mediante la siguiente opción:
        <br><br><br>
        <div style="text-align: center;">
            <a href="{$url_dominio}/ingreso/" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block;
color: #ffffff; background-color: #53ba3e; border-radius: 50px; -webkit-border-radius: 50px;
-moz-border-radius: 50px; width: auto; width: auto; border-top: 1px solid #53ba3e; border-right:
1px solid #53ba3e; border-bottom: 1px solid #53ba3e; border-left: 1px solid #53ba3e; padding-top:
 5px; padding-bottom: 5px; font-family: Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif;
 text-align: center; mso-border-alt: none; word-break: keep-all;"
               target="_blank"><span style="padding-left:50px;padding-right:50px;font-size:16px;
 display:inline-block;"><span style="font-size: 16px; line-height: 2; word-break: break-word;
 mso-line-height-alt: 32px;"><strong>Entrar a CITES Bolivia</strong></span></span></a>
        </div>

        <br>
        <div style="text-align: center;">
            <h2 style="margin: 0px;">Detalle de lo Observado</h2>
        </div>

        {if $item.observado == 1}
            <div style="background-color: #fdfff2; border: 1px solid #c1a936;padding: 5px;font-weight: bolder;color:#99512a;">
                Datos Generales (observación)
            </div>
            <div style="color: red;padding-left: 20px;">
                {$item.observacion}
            </div>
        {/if}

        {if $item.requisitos_observado == 1}
            <div style="background-color: #fdfff2; border: 1px solid #c1a936;padding: 5px;font-weight: bolder;color:#99512a;">
                Datos de Requisitos (observación)
            </div>

            <div style="color: red;padding-left: 20px;">
                {$item.requisitos_observacion}
            </div>
        {/if}

        {if $requisitos_total != 0 }
            <div style="background-color: #fdfff2; border: 1px solid #c1a936;padding: 5px;font-weight: bolder;color:#99512a;">
                Documentación de Requisitos (observación)
            </div>

        <div style="padding-left: 20px;">
            {foreach from=$requisitos item=row key=idx}
                <strong>Requisito: </strong> {$row.nombre}<br>
                <strong>Nombre Archivo: </strong> {$row.adjunto_nombre}<br>
                <strong>Observación: </strong>
                <div style="color: red;">
                    {$row.observacion}
                </div>
                <br>
            {/foreach}
        </div>
        {/if}


    </div>
</div>