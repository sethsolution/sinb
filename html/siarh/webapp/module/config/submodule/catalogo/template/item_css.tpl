{literal}

    <style type="text/css">
    /* KeyTable */
    .oTable.KeyTable td {
    	border: 3px solid transparent;
    }    
    .oTable.KeyTable td.focus {
    	border: 3px solid #3366FF;
    }    
    .oTable.display tr.gradeA {
    	background-color: #eeffee;
    }    
    .oTable.display tr.gradeC {
    	background-color: #ddddff;
    }    
    .oTable.display tr.gradeX {
    	background-color: #ffdddd;
    }    
    .oTable.display tr.gradeU {
    	background-color: #ddd;
    }    
    div.box {
    	height: 100px;
    	padding: 10px;
    	overflow: auto;
    	border: 1px solid #8080FF;
    	background-color: #E5E5FF;
    }
    
    /*
     * Row highlighting example
     */
    .ex_highlight .datatable tbody tr.even:hover, .datatable tbody tr.even td.highlighted {
    	background-color: #ECFFB3;
    }
    
    .ex_highlight .datatable tbody tr.odd:hover, .datatable tbody tr.odd td.highlighted {
    	background-color: #E6FF99;
    }
    
    .ex_highlight_row .datatable tr.even:hover {
    	background-color: #ECFFB3;
    }
    
    .ex_highlight_row .datatable tr.even:hover td.sorting_1 {
    	background-color: #DDFF75;
    }
    
    .ex_highlight_row .datatable tr.even:hover td.sorting_2 {
    	background-color: #E7FF9E;
    }
    
    .ex_highlight_row .datatable tr.even:hover td.sorting_3 {
    	background-color: #E2FF89;
    }
    
    .ex_highlight_row .datatable tr.odd:hover {
    	background-color: #E6FF99;
    }
    
    .ex_highlight_row .datatable tr.odd:hover td.sorting_1 {
    	background-color: #D6FF5C;
    }
    
    .ex_highlight_row .datatable tr.odd:hover td.sorting_2 {
    	background-color: #E0FF84;
    }
    
    .ex_highlight_row .datatable tr.odd:hover td.sorting_3 {
    	background-color: #DBFF70;
    }
    /* 
     * AutoFill styles
     */
    
    div.AutoFill_filler {
    	display: none;
    	position: absolute;
    	height: 14px;
    	width: 14px;
    	background: url(js/DataTables/media/images/filler.png) no-repeat center center;
    	z-index: 1002;
    }
    
    div.AutoFill_border {
    	display: none;
    	position: absolute;
    	background-color: #0063dc;
    	z-index: 1001;
    	
    	box-shadow: 0px 0px 5px #76b4ff;
    	-moz-box-shadow: 0px 0px 5px #76b4ff;
    	-webkit-box-shadow: 0px 0px 5px #76b4ff;
    }
    
    div.tools_oTable{
        padding:2px;        
    }
    
    
    .dataTables_info { padding-top: 0; }
    .dataTables_paginate { padding-top: 0; }
	.css_right { float: right; }
	
    #btnAddNewRow{margin-left:10px;}
    
    
    table.datatable  tr.even.row_selected td {
    	background-color: #B0BED9;
    }
    
    table.datatable  tr.odd.row_selected td {
    	background-color: #9FAFD1;
    }
</style>{/literal}