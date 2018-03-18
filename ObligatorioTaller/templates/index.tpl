{include file="header.tpl"}
<div id="mainBody">
    <div class="container">
        <div class="row">

            <!-- Sidebar con combos ================================================== -->
            <div id="sidebar" class="span3">

                <div class="control-group">
                    <input type="text" name="busqueda" id='busqueda' placeholder="Realiza una busqueda">
                </div>
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
                <button type="submit" id="quitarFiltro" class="btn btn-primary">Limpiar filtros</button>
            </div>



            <!-- Sidebar con combos end=============================================== -->




            <div id="contenido">

            </div>
        </div>
    </div>
</div>
