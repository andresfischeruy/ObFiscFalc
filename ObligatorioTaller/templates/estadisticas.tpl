
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
                        Encontrados: {$arrayEncAbiertas}</br>
                        Perdidas: {$arrayPerdAbiertas}
                        </br>
                        </br><h4>Publicaciones cerradas - Por especie</h4></br>
                        Encontrados: {$arrayEncCerradas}</br>
                        Perdidas: {$arrayPerdCerradas}</br>

                        </br><h4>Éxito de publicaciones cerradas</h4></br>
                        Cantidad de mascotas que se reunieron con su dueño: {$contadorExitosas}</br>
                        Cantidad de mascotas que no se reunieron con su dueño: {$contadorNoExitosas}</br></br></br>
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