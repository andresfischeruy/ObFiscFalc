{include file="header.tpl"}

<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Nuevo aviso</h1>
        <hr class="soften"/>	
        <div class="row">

            <div class="span4">
                <h4>Ingrese los datos de su publicación</h4>
                <form class="form-horizontal" method="POST" action="newPost.php" enctype="multipart/form-data">
                    <div  class='{$tipoAlerta}'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
                        {$mensajeAlerta}
                    </div>

                    <fieldset>
                        <div class="control-group">
                            <input type="text" name ="titulo" placeholder="* Titulo de la publicacion" class="input-xlarge"/>
                        </div>
                        <div class="control-group">
                            *Especie <select name="comboEspecies" id="comboEspecies">
                                {foreach from=$especies item=esp}
                                    <option value="{$esp.nombre}" id="{$esp.id}"> {$esp.nombre} </option>
                                {/foreach}	
                            </select>

                        </div>
                        <div class="control-group">
                            *Raza <select name="comboRazas" id = "comboRazas">

                            </select>
                        </div>
                        <div class="control-group">
                            *Barrio <select name="comboBarrios">
                                {foreach from=$barrios item=bar}
                                    <option value="{$bar.nombre}"> {$bar.nombre} </option>
                                {/foreach}	
                            </select>
                        </div>
                        <div class="control-group">
                            <textarea rows="3" id="textarea" name="descripcion" placeholder="* Descripción" class="input-xlarge"></textarea>
                        </div>

                        <fieldset>
                            <label>
                                <input type="radio" name = "tipo" value = "Perdido" checked = true> Perdido
                            </label>
                            <label>
                                <input type="radio" name = "tipo" value = "Encontrado"> Encontrado
                            </label>
                        </fieldset>

                        <div class="span4">
                            <h4>Agregar imágenes</h4>
                            <div>
                                <input type="file" class="form-control" id="imagenes" name="img[]" multiple="multiple">
                            </div>
                        </div>
                    </fieldset>
                    <button id = "btnPublicar" class="btn btn-large" type="submit">Publicar</button>

                </form>
            </div>



        </div>

    </div>
</div>

</body>
</html>