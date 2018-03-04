
        <div id="mainBody">
            <div class="container">
                <hr class="soften">
                <h1>Cerrar publicacion</h1>
                <hr class="soften"/>	
                <div class="row">

                    <div class="span4">
                        <h4>Mis publicaciones</h4>
                        <form class="form-horizontal" method="POST" action="cerrarPublicacion.php">
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

                                <button id = "btnPublicar" class="btn btn-large" type="submit">Cerrar publicación</button>

                            </fieldset>

                            
                        </form>
                    </div>

                    

                </div>

            </div>
        </div>
        <!-- MainBody End ============================= -->

        <!-- Placed at the end of the document so the pages load faster ============================================= -->
        <script src="themes/js/jquery.js" type="text/javascript"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="themes/js/google-code-prettify/prettify.js"></script>

        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>


    </body>
</html>