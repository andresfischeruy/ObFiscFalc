<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Detalles del aviso</title>
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

                    <div class="span9">

                        <div class="row">	  
                            <div id="gallery" class="span3">
                                <a href="#" title="Fujifilm FinePix S2950 Digital Camera">
                                    <img src="themes/images/products/large/3.jpg" style="width:100%" alt="Fujifilm FinePix S2950 Digital Camera"/>
                                </a>
                                <div id="differentview" class="moreOptopm carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                                            <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                                            <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                                        </div>
                                        <div class="item">
                                            <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                                            <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                                            <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
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
                                <small> Especie de mascota: {$especie.nombre}  </small>
                                <p>
                                    {$publicacion.descripcion}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                    <ul>
                        {foreach from=$fotos item=src}
                            {$src}
                            <li>
                               <img src="{$src}" />
                            </li>
                        {/foreach}             
                    </ul>
                <!--</div>-->

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


            </div>
        </div>

    </div>


</div>

<!-- MainBody End ============================= -->

<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="themes/js/bootshop.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>


</body>
</html>