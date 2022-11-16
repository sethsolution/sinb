<!DOCTYPE html>
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>LAGARTO Bolivia</title>

    {include file="$path_print/index.css.tpl"}
</head>
<body>
{literal}
    <script type="text/php">
   if ( isset($pdf) ) {
        $font = Font_Metrics::get_font("verdana");;
        $size = 6;
        $color = array(0,0,0);
        $text_height = Font_Metrics::get_font_height($font, $size);

        $foot = $pdf->open_object();
        $w = $pdf->get_width();
        $h = $pdf->get_height();
        // Draw a line along the bottom
        $y = $h - $text_height - 24;
        //$pdf->line(16, $y, $w - 16, $y, $color, 0.5);
        $pdf->close_object();
        $pdf->add_object($foot, "all");
        $text = "Pagina {PAGE_NUM} de {PAGE_COUNT}";
        $text = utf8_encode($text);
        // Center the text
        $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
        $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
    }
    </script>
{/literal}

{include file="$path_print/headerfooter.tpl"}
{include file="$path_print/page1.tpl"}

{*
  {include file="$path_print/page2.tpl"}
  {include file="$path_print/page3.tpl"}
  {include file="$path_print/page4.tpl"}
  {include file="$path_print/page5.tpl"}
*}
</body>
</html>