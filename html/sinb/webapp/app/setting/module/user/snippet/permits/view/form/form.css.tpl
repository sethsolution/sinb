{literal}
    <style>
        .custom-file-label::after {
            content: "{/literal}{#gl_search_file#}{literal}" !important;
        }

        .form-table .dtrg-level-0 td{
            background: #d2f0ff !important;
            color: #00709b;
            border-top: 2px solid #c0d8e6;
            padding:2px 2px 2px 10px!important;
            font-weight: normal !important;

        }
        .form-table .dtrg-level-0 td::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f135";
            margin-right: 5px;
        }

        .form-table .dtrg-level-1 td{
            background: #f1fed1 !important;
            color: #5c721b;
            /*border-top: 2px solid #c0d8e6;*/
            padding:2px 2px 2px 15px!important;
        }
        .form-table .dtrg-level-1 td::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f103";
            margin-right: 5px;
        }

        .form-table th{
            padding: 3px!important;
        }

        .form-table tr.even td, .form-table tr.odd td {
            padding: 7px 3px 7px 10px; !important;
        }
    </style>
{/literal}