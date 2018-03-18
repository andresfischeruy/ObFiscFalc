{include file="header.tpl"}
<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->
            <div id="sidebar" class="span3">

                <ul id="sideMenu" class="nav nav-tabs nav-stacked">
                    <li class="subMenu open"><a> TIPO DE PUBLICACIÓN</a>
                        <ul>
                            <li><a class="active" href="index.php?tipo=E&especie={$especie}&raza={$raza}&barrio={$barrio}"><i class="icon-chevron-right"></i>Encontrados </a></li>
                            <li><a href="index.php?tipo=P&especie={$especie}&raza={$raza}&barrio={$barrio}"><i class="icon-chevron-right"></i>Perdidos </a></li>

                        </ul>
                    </li>
                    <li class="subMenu"><a> ESPECIE</a>
                        <ul style="display:none">
                            {foreach from=$especies item=espp}
                                {if $espp.id == {$especie} }
                                    <li><a class="active" href="index.php?tipo={$tipo}&especie={$espp.id}&raza={$raza}&barrio={$barrio}"><i class="icon-chevron-right"></i>{$espp.nombre}</a></li>
                                        {else}
                                    <li><a href="index.php?tipo={$tipo}&especie={$espp.id}&raza={$raza}&barrio={$barrio}"><i class="icon-chevron-right"></i>{$espp.nombre}</a></li> 
                                        {/if}


                            {/foreach}
                        </ul>
                    </li>
                    <li class="subMenu"><a> RAZAS</a>
                        <ul style="display:none">
                            {foreach from=$razas item=razz}
                                <li><a href="index.php?tipo={$tipo}&especie={$especie}&raza={$razz.id}&barrio={$barrio}"><i class="icon-chevron-right"></i>{$razz.nombre}</a></li>
                                    {/foreach}
                        </ul>
                    </li>

                    <li class="subMenu"><a> BARRIO</a>
                        <ul style="display:none">
                            {foreach from=$barrios item=barr}
                                <li><a href="index.php?tipo={$tipo}&especie={$especie}&raza={$raza}&barrio={$barr.id}"><i class="icon-chevron-right"></i>{$barr.nombre}</a></li>
                                    {/foreach}											
                        </ul>
                    </li>

                </ul>
                <br/>
            </div>



            <!-- Sidebar end=============================================== -->

            <div id="contenido">

            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}
