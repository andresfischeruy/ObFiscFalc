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
                                {if $espp.id == especie }
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

            <div class="span9">
                <h4>Publicaciones</h4>

                <ul class="thumbnails">
                    {foreach from=$publicaciones item=pu}
                        <li class="span3">
                            <div class="thumbnail">
                                <a  href="details.php?id={$pu.id}"> <img src="{$fotos[0]}"  alt="Foto de Publicacion"/></a>
                                <div class="caption">
                                    <h5><a  href="details.php?id={$pu.id}">{$pu.titulo}</a></h5>
                                        {if {$pu.tipo} == 'E'}
                                        <h6> Mascota encontrada </h6>
                                    {else}
                                        <h6> Mascota perdida </h6>
                                    {/if}

                                    <p> {$pu.descripcion|truncate:153:"...":true}</p>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
</div>
