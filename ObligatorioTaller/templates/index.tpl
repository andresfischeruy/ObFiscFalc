<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Avisos Mascoteros</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap style --> 
        <link id="callCss" rel="stylesheet" href="themes/css/bootstrap.min.css" media="screen"/>
        <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
        <!-- Bootstrap style responsive -->	
        <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">

        <style type="text/css" id="enject"></style>
    </head>


    <body>
        <div id="header">
            <div class="container">
                <div id="welcomeLine" class="row">
                    {if (!isset($usuario))}
                        <div class="span6">Bienvenido<strong> usuario</strong></div>
                    {else}
                        <div class="span6">Bienvenido<strong> {$usuario.nombre}</strong></div>
                    {/if}
                </div>
                <!-- Navbar ================================================== -->
                <div id="logoArea" class="navbar">
                    <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-inner">
                        <a class="brand" href="index.php"><img src="themes/images/logo.png" alt="Avisos Mascoteros"/></a>
                        <form class="form-inline navbar-search" method="post" action="products.html" >
                            <input id="srchFld" class="srchTxt" type="text" />

                            <button type="submit" id="submitButton" class="btn btn-primary">Ir</button>
                        </form>
                        <ul id="topMenu" class="nav pull-right">


                            <li class="">
                                {if (!isset($usuario))}
                                <li class=""><a href="register.php">Registrarse</a></li>
                                <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
                            {else}
                                <li class=""><a href="newPost.php">Nueva Publicación</a></li>
                                <li class=""><a href="cerrarPublicacion.php">Cerrar Publicación</a></li>
                                <li class=""><a href="#">Estadisticas</a></li>
                                <a href="doLogout.php" role="button" style="padding-right:0"><span class="btn btn-large btn-success">Salir</span></a>
                            {/if}

                            <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3>Iniciar Sesión</h3>
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
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End====================================================================== -->

        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <!-- Sidebar ================================================== -->
                    <div id="sidebar" class="span3">

                        <ul id="sideManu" class="nav nav-tabs nav-stacked">
                            <li class="subMenu open"><a> TIPO DE PUBLICACIÓN</a>
                                <ul>
                                    <li><a class="active" href="index.php?tipo=E"><i class="icon-chevron-right"></i>Encontrados </a></li>
                                    <li><a href="index.php?tipo=P"><i class="icon-chevron-right"></i>Perdidos </a></li>

                                </ul>
                            </li>
                            <li class="subMenu"><a> ESPECIE</a>
                                <ul style="display:none">
                                    {foreach from=$especies item=espp}
                                        <li><a href="index.php?tipo={$tipo}&especie={$espp.id}&raza={$raza}&barrio={$barrio}"><i class="icon-chevron-right"></i>{$espp.nombre}</a></li>
                                            {/foreach}
                                </ul>
                            </li>
                            <li class="subMenu"><a> RAZAS</a>
                                <ul style="display:none">
                                    {foreach from=$razas item=razz}
                                        <li><a href="index.php?tipo={$tipo}&especie={$especie}&raza={$razz.id}&barrio={$barrio}"><i class="icon-chevron-right"></i>{$razz.nombre}</a></li>
                                            {/foreach}
                                </ul>
                            </li>

                            <li class="subMenu"><a> BARRIO</a>
                                <ul style="display:none">
                                    {foreach from=$barrios item=barr}
                                        <li><a href="index.php?tipo={$tipo}&especie={$especie}&raza={$raza}&barrio={$barr.id}"><i class="icon-chevron-right"></i>{$barr.nombre}</a></li>
                                            {/foreach}											
                                </ul>
                            </li>

                        </ul>
                        <br/>


                    </div>
                    <!-- Sidebar end=============================================== -->

                    <h4>Publicaciones</h4>

                    <ul class="thumbnails">
                        
                            {foreach from=$publicaciones item=pu}
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a  href="#"><img src="themes/images/products/1.jpg" alt="Foto de Publicacion"/></a>
                                        <div class="caption">
                                            <h5>{$pu.titulo}</h5>
                                            <p> {$pu.descripcion}</p>
                                        </div>
                                    </div>
                                </li>
                            {/foreach}
                       
                    </ul>


                </div>
            </div>
        </div>
        <!-- Placed at the end of the document so the pages load faster ============================================= -->
        <script src="themes/js/jquery.js" type="text/javascript"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>

    </body>
</html>