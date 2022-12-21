{literal}
    <style>
        @page { margin: 80px 25px 35px 25px; }
        @font-face {
            font-family: "Lato";
            font-weight: normal;
            font-style: italic;
            src: url("{/literal}{$path_image}{literal}font/Lato-Italic.ttf") format("truetype");
        }
        @font-face {
            font-family: "Lato";
            font-weight: normal;
            src: url("{/literal}{$path_image}{literal}font/Lato-Regular.ttf") format("truetype");
        }
        @font-face {
            font-family: "Lato";
            font-weight: bold;
            src: url("{/literal}{$path_image}{literal}font/Lato-Bold.ttf") format("truetype");
        }
        @font-face {
            font-family: "Lato";
            font-weight: bold;
            font-style: italic;
            src: url("{/literal}{$path_image}{literal}font/Lato-BoldItalic.ttf") format("truetype");
        }

        @font-face {
            font-family: "Lato";
            font-weight: 900;
            src: url("{/literal}{$path_image}{literal}font/Lato-Black.ttf") format("truetype");
        }
        @font-face {
            font-family: "Lato";
            font-weight: 900;
            font-style: italic;
            src: url("{/literal}{$path_image}{literal}font/Lato-BlackItalic.ttf") format("truetype");
        }

        *{
            font-family: "Lato";
            font-size:12px;
        }
        body {

        }
        header { position: fixed;  top: -70px; left: 0px; right: 0px;
            border-bottom: 1px solid #BCBCBC;
        }
        footer { position: fixed; bottom: -22px; left: 0px; right: 0px;
            border-top: 1px solid #BCBCBC;
        }

        p { page-break-after: always; }
        table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        td.logo{
            width: 270px;
            text-align: left;
            /*border: 0.4px solid black;*/
        }
        .header-resumen td{
            text-align: center;
            font-size: 8px;
            color: #575656;
            padding: 0px;
            border-bottom: 1px solid #e8e8e8;
        }
        .tabla-titulo-top{
            width: 60px;
            background: #f8f8f8;
        }

        .pagina{
            text-align: center;
            font-family: "Lato";
            font-size: 9px;
        }
        .page-number:before {
            content: "Página " counter(page);
            color: #575656;
            font-size: 9px;
        }
        .footer{
            color: #575656;
            font-size: 9px;
        }
        .sinpreh{
            font-size: 9px;
            /*color:#0a6c99;*/
            font-weight: bold;
            color: white;
            background: #0a6c99;
            padding: 1px 5px 1px 5px;
        }



        .item-titulo{
            background: #fffaee;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            color: #412d34;
            padding: 2px 2px 2px 2px;
            /*margin: 0px 0px 0px 0px;*/
            border-bottom: 2px solid #f5ead0;
            border-top: 2px solid #f5ead0;
        }
        .item-tabla-titulo{
            width: 170px;
            background: #f8f8f8;
            font-weight: bold;
            color: #575656;
        }
        .item-tabla-header{
            width: 170px;
            text-align: center;
            background: #ffffff;
            font-weight: bold;
            color: #022902;
        }
        .item-tabla-monto_total{
            width: 170px;
            text-align: right;
            background: #ece8e8;
            font-weight: bold;
            color: #022902;
        }

        .item-tabla{
            margin-top: 5px;
        }
        .item-tabla td{
            border: 1px solid #dadada;
            padding: 2px;
        }

        .txtRight{text-align: right;}
        .txtLeft{text-align: left;}
        .txtCenter{text-align: center;}

    </style>
{/literal}