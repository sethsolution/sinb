{literal}<style>
    .ui-autocomplete-loading {
        background: white url('./template/user/images/loading/ui-anim_basic_16x16.gif') right center no-repeat;
    }
    
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    /* IE 6 doesn't support max-height
     * we use height instead, but this forces the menu to always be this tall
     */
    * html .ui-autocomplete {
        height: 100px;
    }
    
  .ui-progressbar {
    position: relative;
    margin-top:50px;
  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
    color:#ffffff;
  }
  
  td.txtCenter{
    text-align:center;
  }
  td.txtRigth{
    text-align:right;
  }
</style>{/literal}