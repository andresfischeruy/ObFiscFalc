<div class="span9">
    <h4>Publicaciones</h4>

    <ul class="thumbnails">
        {foreach from=$publicaciones item=pu}
            <li class="span3">
                <div class="thumbnail">
                    <a  href="details.php?id={$pu.id}" target="_blank"> <img id = 'fotoPubli' src="{$pu.fotos[0]}"  alt="Foto de Publicacion"/></a>
                    <div class="caption">
                        <h5><a  href="details.php?id={$pu.id}" target="_blank">{$pu.titulo}</a></h5>
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
    <div id='divBotones'>
        {if $mostrarAnterior}
            <button id="anterior" class="btn btn-primary">Anterior</button>
        {/if}

        {if $mostrarSiguiente}
            <button id="siguiente" class="btn btn-primary">Siguiente</button
        {/if}
    </div>

</div>