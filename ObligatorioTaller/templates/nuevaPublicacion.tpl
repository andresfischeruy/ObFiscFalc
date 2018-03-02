<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Registrar aviso</title>
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
                        <a class="brand" href="index.php"><img src="themes/images/logo.png" alt="Avisos mascoteros"/></a>

                        <ul id="topMenu" class="nav pull-right">
                            <li class=""><a href="index.php">Home</a></li>

                            <li class="">
                                {if (!isset($usuario))}
                                <li class=""><a href="register.php">Registrarse</a></li>
                                <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
                            {else}
                                <li class=""><a href="newPost.php">Nueva Publicación</a></li>
                                <li class=""><a href="#">Estadisticas</a></li>
                                <a href="doLogout.php" role="button" style="padding-right:0"><span class="btn btn-large btn-success">Salir</span></a>
                            {/if}
                            <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3>Iniciar Sesión</h3>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal loginFrm">
                                        <div class="control-group">								
                                            <input type="text" id="inputEmail" placeholder="Email">
                                        </div>
                                        <div class="control-group">
                                            <input type="password" id="inputPassword" placeholder="Password">
                                        </div>

                                    </form>		
                                    <button type="submit" class="btn btn-success">Iniciar sesión</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
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
                <hr class="soften">
                <h1>Nuevo aviso</h1>
                <hr class="soften"/>	
                <div class="row">

                    <div class="span4">
                        <h4>Ingrese los datos de su publicación</h4>
                        <form class="form-horizontal" method="POST" action="newPost.php" enctype="multipart/form-data">
                            <fieldset>
                                <div class="control-group">
                                    <input type="text" name ="titulo" placeholder="* Titulo de la publicacion" class="input-xlarge"/>
                                </div>
                                <div class="control-group">
                                    *Especie <select name="comboEspecies">
                                        {foreach from=$especies item=esp}
                                            <option value="{$esp.nombre}"> {$esp.nombre} </option>
                                        {/foreach}	
                                    </select>

                                </div>
                                <div class="control-group">
                                    *Raza <select name="comboRazas">
                                        {foreach from=$razas item=raz}
                                            <option value="{$raz.nombre}"> {$raz.nombre} </option>
                                        {/foreach}	
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
                            <div  class='{$tipoAlerta}'>
                                <button type='button' class='close' data-dismiss='alert'>×</button>
                                {$mensajeAlerta}
                            </div>
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