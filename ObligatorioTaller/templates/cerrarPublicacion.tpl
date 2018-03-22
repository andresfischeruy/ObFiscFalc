{include file="header.tpl"}
<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Cerrar publicacion</h1>
        <hr class="soften"/>	
        <div class="row">

            <div class="span4">
                <h4>Mis publicaciones</h4>
                <form class="form-horizontal" method="POST" action="cerrarPublicacionIntermedia.php">
                    <fieldset>

                        <div class="control-group">
                            <select name="comboPublicaciones">
                                {foreach from=$publicaciones item=publi}
                                    <option value="{$publi.titulo}"> {$publi.titulo} </option>
                                {/foreach}	
                            </select>

                        </div>

                        <fieldset>
                            ¿La mascota se reunio con su dueño?
                            <label>
                                <input type="radio" name = "tipo" value = "Reunido" checked = true> Si
                            </label>
                            <label>
                                <input type="radio" name = "tipo" value = "NoReunido"> No
                            </label>
                        </fieldset>

                        <button id = "btnPublicar" class="btn btn-primary" type="submit">Cerrar publicación</button>

                    </fieldset>


                </form>
            </div>



        </div>

    </div>
</div>