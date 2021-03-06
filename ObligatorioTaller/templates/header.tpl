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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="themes/js/javascript.js" type="text/javascript"></script> 
        <script src="themes/js/paginadoFiltros.js" type="text/javascript"></script> 

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
                        <a class="brand" href="index.php"><img id="logo" src="themes/images/logo.png" alt="Avisos Mascoteros"/></a>
                        
                        <ul id="topMenu" class="nav pull-right">


                            <li class="">
                                {if (!isset($usuario))}
                                <li class=""><a href="register.php">Registrarse</a></li>
                                <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-primary">Login</span></a>
                            {else}
                                <li class=""><a href="newPost.php">Nueva Publicación</a></li>
                                <li class=""><a href="cerrarPublicacion.php">Cerrar Publicación</a></li>
                                <li class=""><a href="estadisticas.php">Estadisticas</a></li>
                                <a href="doLogout.php" role="button" style="padding-right:0"><span class="btn btn-large btn-primary">Salir</span></a>
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
                                        <input type="submit" class="btn btn-primary btn-lg" value="Iniciar sesión" >
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
