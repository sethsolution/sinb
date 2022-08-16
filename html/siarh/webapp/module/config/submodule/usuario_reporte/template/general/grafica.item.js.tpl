{literal}

<script>
    var chart1, chart2;
    
    $(document).ready(function (){
            chart1 = new cfx.Chart();
            chart1.setGallery(cfx.Gallery.Pie);
            chart1.getAllSeries().getPointLabels().setVisible(true);
            chart1.getAllSeries().getPointLabels().setFont("8px Arial");
            var myPie;
            myPie = (chart1.getGalleryAttributes());
            myPie.setLabelsInside(false);
            myPie.setExplodingMode(cfx.ExplodingMode.All);

            var title;
            title = new cfx.TitleDockable();
            chart1.getTitles().add(title);
            chart1.getLegendBox().setContentLayout(cfx.ContentLayout.Center);

            var data = [
                    {/literal}{foreach item=row from=$item name=departamento}
                    
                      {if $smarty.foreach.departamento.iteration != 1},{/if}{literal}
                      { "Agrupado": "{/literal}{$row.Nombre|utf8_encode}{literal}" ,
                      "Total": {/literal}{$row.total}{literal}}
                      
                    {/literal}{/foreach}{literal}
                ];

            chart1.setDataSource(data);
            var id = "{/literal}{$tipo}{literal}";
            var divHolder = document.getElementById('ChartDiv'+id);
            chart1.create(divHolder);
            
    });//END READY

</script>
{/literal}