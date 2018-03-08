{foreach from=$razas item=raza}
    <div class="producto">
        <option id="{$raza.id}">{$raza.nombre}</option>
    </div>
{/foreach}
