{include file="header.tpl"}
<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Estadisticas</h1>
        <hr class="soften"/>	
        <div class="row">

            <div class="span4">
                <h4>Total de publicaciones</h4>
                Encontradas: {$contadorEncontradas} </br>
                Perdidas: {$contadorPerdidas} </br>

                </br><h4>Publicaciones abiertas - Por especie</h4></br>
                {foreach from=$arrayEncAbiertas item=item}
                    {$item.nombreEspecie} encontrados: {$item.cantidad}</br>
                {/foreach}

                {foreach from=$arrayPerdAbiertas item=item}
                   {$item.nombreEspecie} perdidos: {$item.cantidad}</br>
                {/foreach}
                </br>
                </br><h4>Publicaciones cerradas - Por especie</h4></br>
                 {foreach from=$arrayEncCerradas item=item}
                    {$item.nombreEspecie} encontrados: {$item.cantidad}</br>
                {/foreach}

                {foreach from=$arrayPerdCerradas item=item}
                    {$item.nombreEspecie} perdidos: {$item.cantidad}</br>
                {/foreach}

                </br><h4>Éxito de publicaciones cerradas</h4></br>
                Cantidad de mascotas que se reunieron con su dueño: {$contadorExitosas}</br>
                Cantidad de mascotas que no se reunieron con su dueño: {$contadorNoExitosas}</br></br></br>
            </div>

        </div>

    </div>
</div>