
        <div id="mainBody">
            <div class="container">
                <div class="row">


                    <p class="ml-auto">
                    <div class="dropdown">

                        <button class="btn btn-secondary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Perdido/Encontrado<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?tipo=E&especie={$especie}&raza={$raza}&barrio={$barrio}">Encontrado</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?tipo=P&especie={$especie}&raza={$raza}&barrio={$barrio}">Perdido</a></li>
                        </ul>

                    </div>
                    </p>

                    <p class="ml-auto">
                    <div class="dropdown">

                        <button class="btn btn-secondary dropdown-toggle " id="menu1" type="button" data-toggle="dropdown">Especies<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                            {foreach from=$especies item=espp}
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?tipo={$tipo}&especie={$espp.id}&raza={$raza}&barrio={$barrio}">{$espp.nombre}</a></li>
                                {/foreach}	
                        </ul>

                    </div>
                    </p>
                    <p class="ml-auto">
                        {if $especie}
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Razas<span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                                {foreach from=$razas item=razz}
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?tipo={$tipo}&especie={$especie}&raza={$razz.id}&barrio={$barrio}">{$razz.nombre}</a></li>
                                    {/foreach}	
                            </ul>
                        </div>
                    {/if}
                    </p>
                    <p class="ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Barrios<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                            {foreach from=$barrios item=barr}
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?tipo={$tipo}&especie={$especie}&raza={$raza}&barrio={$barr.id}">{$barr.nombre}</a></li>
                                {/foreach}	
                        </ul>
                    </div>
                    </p>


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
    </body>
    <!-- Placed at the end of the document so the pages load faster ============================================= -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="themes/js/bootshop.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>

</body>
</html>