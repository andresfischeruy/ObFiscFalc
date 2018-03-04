
<div id="mainBody">
    <div class="container">
        <div class="row">

            <div class="span9">

                <div class="row">	  
                    <div id="gallery" class="span3">

                        <div id="differentview" class="moreOptopm carousel slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    {foreach from=$fotos item=src}
                                        <img src="{$src}" />
                                    {/foreach}   
                                </div>
                                <div class="item">
                                    <!--     {foreach from=$fotos item=src}
                                             <img src="{$src}" />
                                    {/foreach} -->
                                    </div>



                                </div>

                            </div>

                        </div>

                        <div class="span6">
                            <h3>{$publicacion.titulo}</h3>
                            {if {$publicacion.tipo == 'E'}}
                                <small> Encontrado</small> <br>
                            {else}
                                <small> Perdido</small> <br>
                            {/if}
                            <small> Especie de mascota: {$especie.nombre}  </small><br>
                            <small> Raza de mascota: {$raza.nombre}  </small>
                            <p>
                                {$publicacion.descripcion}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <h1>Preguntas</h1>
            <hr class="soften"/>	

            {foreach from=$preguntas item=preg}
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <h4><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                    {$preg.texto}
                                </a></h4>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse"  >
                            <div class="accordion-inner">
                                {$preg.respuesta}
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}
            {if (isset($usuario))}
                <div>    
                    <h3>Nueva pregunta</h3>
                </div>
                <div>
                    <form  method="POST" action="details.php?id={$publicacion.id}" >
                        <div class="col-sm-10">
                            <textarea name = 'pregunta' id = 'inputPregunta' class="form-control" rows="3" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Preguntar</button>
                    </form>
                </div>
            </div>
        {else}
            <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Inicia sesión para realizar una pregunta</span></a>
            <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3>Iniciar sesion</h3>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="doLogin.php" >
                        <div class="control-group">								
                            <input type="text" id="inputEmail" placeholder="Email" name="usuario">
                        </div>
                        <div class="control-group">
                            <input type="password" id="inputPassword" placeholder="Password" name="clave">
                        </div>

                        <input type="submit" class="btn btn-success" value="Iniciar sesión" >
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                    </form>		
                </div>
            </div>
        {/if}



    </div>
</div>

</div>


</div>
