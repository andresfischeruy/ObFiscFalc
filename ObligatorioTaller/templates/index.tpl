{include file="header.tpl"}
<div id="mainBody">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar con combos ================================================== -->
            <div id="sidebar" class="span3">

                    <div class="control-group">
                        <select name="comboTiposIndex" id="comboTiposIndex">
                            <option value=""> Seleccione un tipo </option>
                            <option value="E" id="Encontrado"> Encontrado </option>
                            <option value="P" id="Perdido"> Perdido </option>
                        </select>

                    </div>

                    <div class="control-group">
                        <select name="comboEspeciesIndex" id="comboEspeciesIndex">
                            <option value=""> Seleccione una especie </option>
                            {foreach from=$especies item=esp}
                                <option value="{$esp.id}"> {$esp.nombre} </option>
                            {/foreach}	
                        </select>

                    </div>

                    <div class="control-group">

                        <select name="comboRazasIndex" id = "comboRazasIndex">
                            <option value=""> Seleccione una raza </option>
                        </select>
                    </div>
                    <div class="control-group">
                        <select name="comboBarriosIndex" id='comboBarriosIndex'>
                            <option value=""> Seleccione un barrio </option>
                            {foreach from=$barrios item=bar}
                                <option value="{$bar.id}"> {$bar.nombre} </option>
                            {/foreach}	
                        </select>
                    </div>

                        <button type="submit" id="filtrar" class="btn btn-primary">Aplicar filtros</button>
            </div>



            <!-- Sidebar con combos end=============================================== -->
            
            
            <!-- Sidebar ================================================== 
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
