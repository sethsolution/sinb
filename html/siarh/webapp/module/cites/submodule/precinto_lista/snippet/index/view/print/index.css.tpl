{literal}
    <style type="text/css">

        .cuadro{
            border:1px solid #cbcbcb;
            /*height: 100%;*/
            border-radius: 5px 5px 5px 5px;
            -moz-border-radius: 5px 5px 5px 5px;
            -webkit-border-radius: 5px 5px 5px 5px;
        }
        .cuadro-verde{
            border:1px solid #34bfa3;
            height: 100%;
            border-radius: 5px 5px 5px 5px;
            -moz-border-radius: 5px 5px 5px 5px;
            -webkit-border-radius: 5px 5px 5px 5px;
        }
        .cuadro-padding-0{
            padding: 0px !important;
        }
        .cuadro-margin-0{
            margin: 0px !important;
        }
        .cuadro-padding-5{
            padding: 5px !important;
        }
        .cuadro-padding-10{
            padding: 10px !important;
        }
        .cuadro-align-top{
            vertical-align: top;
        }
        .titulo{
            border-bottom: 1px solid #34bfa3;
            padding-bottom: 15px;
        }



        @page { margin: 70px 25px; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 10px;
            margin-bottom: 35px;
            font-size:11px;
        }
        header { position: fixed; top: -50px; left: 0px; right: 0px; }
        footer { position: fixed; bottom: -30px; left: 0px; right: 0px; }
        p { page-break-after: always; }

        .conclusiona{
            font-size: 14px;
            padding: 30px;
            text-align:justify;
            border: 1px solid black;
        }
        .siop{
            padding:5px;
            text-align:center;
            background:#f8ffef !important;
            color:#208505;
            text-align:center;
            border-left: 0.7px solid #208505;
            border-right: 0.7px solid #208505;
            border-top: 0.5px solid #9d9d9d;
            border-bottom: 0.5px solid #9d9d9d;
            font-size: 9px;
        }
        .noop{
            padding:5px;
            text-align:center;
            background:#ffefef !important;
            color:#d50606;
            text-align:center;
            border-left: 0.7px solid #d50606;
            border-right: 0.7px solid #d50606;
            border-top: 0.5px solid #9d9d9d;
            border-bottom: 0.5px solid #9d9d9d;
            font-size: 9px;
        }

        .op_1{
            padding:5px;
            text-align:center;
            background:#f8ffef !important;
            color:#208505;
            border-left: 0.7px solid #208505;
            border-right: 0.7px solid #208505;
            border-top: 0.5px solid #9d9d9d;
            border-bottom: 0.5px solid #9d9d9d;
            font-size: 9px;
        }
        .op_1_resp{
            padding:5px;
            background:#f8ffef !important;
            color:#208505;
            border: 0.7px solid #208505;
            text-align:center;
        }
        .op_2{
            padding:5px;
            text-align:center;
            background:#fff4b8 !important;
            color:#ab7900;
            border-left: 0.7px solid #ab7900;
            border-right: 0.7px solid #ab7900;
            border-top: 0.5px solid #9d9d9d;
            border-bottom: 0.5px solid #9d9d9d;
            font-size: 9px;
        }
        .op_2_resp{
            padding:5px;
            background:#fff4b8 !important;
            color:#ab7900;
            border: 0.7px solid #ab7900;
            text-align:center;
        }
        .op_3{
            padding:5px;
            text-align:center;
            background:#ffefef !important;
            color:#d50606;
            border-left: 0.7px solid #d50606;
            border-right: 0.7px solid #d50606;
            border-top: 0.5px solid #9d9d9d;
            border-bottom: 0.5px solid #9d9d9d;
            font-size: 9px;
        }
        .op_3_resp{
            padding:5px;
            background:#ffefef !important;
            color:#d50606;
            border: 0.7px solid #d50606;
            text-align:center;
        }
        .op_4{
            padding:5px;
            text-align:center;
            background:#f7f7f7 !important;
            color:#c8c8c8;
            border-left: 0.7px solid #c8c8c8;
            border-right: 0.7px solid #c8c8c8;
            border-top: 0.5px solid #9d9d9d;
            border-bottom: 0.5px solid #9d9d9d;
            font-size: 9px;
        }
        .op_4_resp{
            padding:5px;
            background:#f7f7f7 !important;
            color:#c8c8c8;
            border: 0.7px solid #c8c8c8;
            text-align:center;
        }

        .titulo01{
            font-size: 14px;
            font-weight: bolder;
            text-align: center;
        }

        .row_normal{
            font-size: 10px;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 3px;
            padding-bottom: 3px;
        }
        .txtRight{text-align: right;}
        .txtLeft{text-align: left;}
        .txtCenter{text-align: center;}

        .header_title{
            font-size: 16px;
            font-weight: bold;
            color: #01578f;
            padding: 10px 2px 2px 2px;
            margin: 0px 0px 5px 0px;
            border-bottom: 2px solid #01568e;
            text-align: center;
        }

        .pregunta{
            font-size: 9px;
            font-weight: bold;
            padding: 2px 5px 2px 2px;
            border: 0.5px solid #9d9d9d;
            text-align: right;
            background: #f2f2f2;
        }

        .pregunta2{
            font-size: 9px;
            font-weight: bold;
            padding: 2px 5px 2px 2px;
            border: 0.5px solid #bcc5c2 ;
            border-bottom: 0px solid #bcc5c2 ;
            text-align: left;
            color: #1b0000;

        }
        .preguntaMedio{
            font-size: 9px;
            font-weight: bold;
            padding: 2px 5px 2px 2px;
            border: 0.5px solid #bcc5c2 ;
            border-bottom: 0px solid #bcc5c2 ;
            border-top: 0px;
            text-align: left;
            color: #1b0000;

        }


        table {
            width: 70%;
            border-collapse: collapse;
            border: none;
        }
        .table-footer{
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .page-number:before {
            content: "Página " counter(page);
        }

    </style>
{/literal}