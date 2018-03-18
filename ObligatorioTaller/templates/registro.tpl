{include file="header.tpl"}
<div id="mainBody">
    <div class="container">

        <div class="span9">

            <h3> Registro de usuario</h3>	
            <div class="well">
                <form class="form-horizontal" method="POST" action="register.php">

                    <div class="control-group">
                        <label class="control-label" for="inputFname1" >Nombre completo <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" id="inputFname1" name = "nombre">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="input_email">Email <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" id="input_email" name = "email" >
                        </div>
                    </div>	  
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
                        <div class="controls">
                            <input type="password" id="inputPassword1" name = "password">
                        </div>
                    </div>	  

                    <div  class='{$tipoAlerta}'>
                        <button type='button' class='close' data-dismiss='alert'>×</button>
                        {$mensajeAlerta}
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="email_create" value="1">
                            <input type="hidden" name="is_new_customer" value="1">
                            <input class="btn btn-large btn-success" type="submit" value="Registrarse" />
                        </div>
                    </div>		
                </form>
            </div>

        </div>
    </div>
</div>