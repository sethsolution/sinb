<ul id="nav">
    {section name=i loop=$item}
        <li><a href="#">{$item[i].nombre}</a>
            <ul>
                {section name=e loop=$item[i].subModule}
                    {if $item[i].subModule[e].tipo == 'URL'}
                        <li>
                            <a href="{$item[i].subModule[e].url}"
                               target="{if $item[i].subModule[e].ventana == 1}_blank{else}center{/if}">
                                <img src="{$templateDir}images/icon/bullet3.gif" border="0" />
                                {$item[i].subModule[e].nombre}
                            </a>
                        </li>
                    {else}
                        <li>
                            <a href="index.php?module={$item[i].subModule[e].carpetaModulo}&smodule={$item[i].subModule[e].carpeta}"
                               target="{if $item[i].subModule[e].ventana == 1}_blank{else}center{/if}" >
                                <img src="{$templateDir}images/icon/bullet3.gif" border="0" />
                                {$item[i].subModule[e].nombre}
                            </a>
                        </li>
                    {/if}
                {/section}
            </ul>
        </li>
    {/section}
</ul>
{literal}
    <script>
        $(document).ready(function () {
            $('#nav > li > a').click(function(){
                if ($(this).attr('class') != 'active'){
                    $('#nav li ul').slideUp();
                    $(this).next().slideToggle();
                    $('#nav li a').removeClass('active');
                    $(this).addClass('active');
                }
            });
        });
    </script>
{/literal}