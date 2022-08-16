<?php
$CFG->telegram["activo"] = true;
/**
 * Token del bot en telegram
 */
$CFG->telegram["token"] = "";
/**
 * ID del canal o la persona que se enviará el mensaje en telegram
 */
$CFG->telegram["chat_id"] = "-1001329734338"; // grupo cites

$CFG->telegram["parse_mode"] ='HTML';
$CFG->telegram["log"] =true; //enviar logs a telegram