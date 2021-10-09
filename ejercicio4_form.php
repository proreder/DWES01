<form action="ejercicio4_alta.php" method="post">
<div>
    <div>
        <label>Nombre:
        <input type="text" name="nombre" >
        </label>
    </div>
    <div>
        <label>Apellidos:
        <input type="text" name="apellidos" >
        </label>
    </div>
    <div>
        <label>Email:
        <input type="text" name="email" >
        </label>
    </div>
    <div>
        <label>Repetición del email:
        <input type="text" name="remail" >
        </label>
    </div>
    <div>
        <label>Teléfono: 
        <input type="text" name="telefono">
        </label>
    </div>
    <div>
        <label>Planta: 
        <select name="planta">
            <option value="0">Bajo</option>
            <option value="1">1ª Planta</option>
            <option value="2">2ª Planta</option>
            <option value="3">3ª Planta</option>
            <option value="4">4ª Planta</option>
            <option value="5">5ª Planta</option>
            <option value="6">Áticos</option>
        </select>
        </label>
    </div>
    <div>
        <div>
            <label><input name="puerta" type="radio" value="1"> Puerta 1</label>
            <label><input name="puerta" type="radio" value="2"> Puerta 2</label>
            <label><input name="puerta" type="radio" value="3"> Puerta 3</label>
            <label><input name="puerta" type="radio" value="4"> Puerta 4</label>
            <label><input name="puerta" type="radio" value="5"> Puerta 5</label>
            <label><input name="puerta" type="radio" value="6"> Puerta 6</label>
        </div>
    </div>
    <div>
        <label>Password
        <input type="password" name="password">
        </label>
        
    </div>
    <div>
        <label>Repetición del password
            <input type="password" name="repassword" >
        </label>
    </div>
    <div>
        <label>Señale de las siguientes casillas las que encajen con su situación:
            <br>
        </label>
        <div>
            <div>
                <input type="checkbox" name="opts[garaje]" value="si">
                <label>Dispongo de una o más plazas de garaje</label>
            </div>
            <div>
                <input type="checkbox" name="opts[alquilado]" value="si"> 
                <label>Piso alquilado</label>                
            </div>
            <div>
                <input type="checkbox" name="opts[trastero]" value="si"> 
                <label>Dispongo de uno o más trasteros</label>                
            </div>
        </div>
    </div>
    <div>
        <input type="submit" value="Solicitar alta">
    </div>
</div>
</form>