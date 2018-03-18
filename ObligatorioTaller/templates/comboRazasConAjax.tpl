        
<option value="">Seleccione una raza</option>
{foreach from=$razas item=raza}
    <div class="producto">
        <option value="{$raza.id}" id="{$raza.id}">{$raza.nombre}</option>
    </div>
{/foreach}
