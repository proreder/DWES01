<form style="width:600px" action="ejercicio4_alta.php" method="post">
<fieldset>
    <legend>Formulario de alta</legend>

        <div>
            <div>
                <label>Nombre....................:
                <input  style="<?php isset($arrayErrores['nombre']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>" type="text" name="nombre" value="<?php isset($nombre) ? print $nombre : ""; ?>"/>
                </label>
            </div>
            <div>
                <label>Apellidos.................:
                <input style="<?php isset($arrayErrores['apellido']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>"  type="text" name="apellidos" value="<?php isset($apellidos) ? print $apellidos : ""; ?>"/>
                </label>
            </div>
            <div>
                <label>Email.......................:
                <input style="<?php isset($arrayErrores['email']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>" type="text" name="email" value="<?php isset($email) ? print $email : ""; ?>"/>
                </label>
            </div>
            <div>
                <label>Repetición del email:
                <input style="<?php isset($arrayErrores['remail']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>" type="text" name="remail" value="<?php isset($remail) ? print $remail : ""; ?>"/>
                </label>
            </div>
            <div>
                <label>Teléfono.................: 
                <input style="<?php isset($arrayErrores['telefono']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>" type="text" name="telefono" value="<?php isset($telefono) ? print $telefono : ""; ?>"/>
                </label>
            </div>
            <div>
                <label>Planta: 
                <select name="planta" style="<?php isset($arrayErrores['planta']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>">
                    <option value="0" <?php if($planta=="0") echo 'selected="selected"'; ?>>Bajo</option>
                    <option value="1" <?php if($planta=="1") echo 'selected="selected"'; ?>>1ª Planta</option>
                    <option value="2" <?php if($planta=="2") echo 'selected="selected"'; ?>>2ª Planta</option>
                    <option value="3" <?php if($planta=="3") echo 'selected="selected"'; ?>>3ª Planta</option>
                    <option value="4" <?php if($planta=="4") echo 'selected="selected"'; ?>>4ª Planta</option>
                    <option value="5" <?php if($planta=="5") echo 'selected="selected"'; ?>>5ª Planta</option>
                    <option value="6" <?php if($planta=="6") echo 'selected="selected"'; ?>>Áticos</option>
                </select>
                </label>
            </div>
            <div>
                <div style="<?php isset($arrayErrores['puerta']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>">
                    <label><input name="puerta" type="radio" value="1" <?php if($puerta=="1") echo 'checked'; ?>> Puerta 1</label>
                    <label><input name="puerta" type="radio" value="2" <?php if($puerta=="2") echo 'checked'; ?>> Puerta 2</label>
                    <label><input name="puerta" type="radio" value="3" <?php if($puerta=="3") echo 'checked'; ?>> Puerta 3</label>
                    <label><input name="puerta" type="radio" value="4" <?php if($puerta=="4") echo 'checked'; ?>> Puerta 4</label>
                    <label><input name="puerta" type="radio" value="5" <?php if($puerta=="5") echo 'checked'; ?>> Puerta 5</label>
                    <label><input name="puerta" type="radio" value="6" <?php if($puerta=="6") echo 'checked'; ?>> Puerta 6</label>
                </div>
            </div>
            <div>
                <label>Password
                <input style="<?php isset($arrayErrores['password']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>" type="password" name="password">
                </label>
                
            </div>
            <div>
                <label>Repetición del password
                    <input style="<?php isset($arrayErrores['repassword']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF'); ?>" type="password" name="repassword" >
                </label>
            </div>
            <div>
                <label>Señale de las siguientes casillas las que encajen con su situación:
                    <br>
                </label>
                
                <div style="<?php isset($arrayErrores['situacion']) ? print ('background-color: #f8aaa2') : print ('background-color: #FFF')."hola"; ?>">
                    <div>
                        <input type="checkbox" name="opts[garaje]" value="si"  <?php  $check=!empty($garaje) ? 'checked' : 'unchecked'; echo $check;?>>
                        <label>Dispongo de una o más plazas de garaje</label>
                    </div>
                    <div>
                        <input type="checkbox" name="opts[alquilado]" value="si"<?php  $check=!empty($alquilado) ? 'checked' : 'unchecked'; echo $check;?>> 
                        <label>Piso alquilado</label>                
                    </div>
                    <div>
                        <input  type="checkbox" name="opts[trastero]" value="si" <?php  $check=!empty($trastero) ? 'checked' : 'unchecked'; echo $check;?>> 
                        <label>Dispongo de uno o más trasteros</label>                
                    </div>
                </div>
            </div>
            <br>
            <div>
                <input type="submit" value="Solicitar alta">
            </div>
        </div>
        </form>
        <br>
        <div style="<?php isset($arrayErrores) && !empty($arrayErrores) ? print ('border: 1px solid red') : print ('border: 1px solid white'); ?>">
            <?php
                if(isset($arrayErrores) && !empty($arrayErrores)){
                    foreach($arrayErrores as $texto){
                        echo "<span>${texto}</span><br>";
                    }
                }
            ?>
        </div>
    </fieldset>
</form>