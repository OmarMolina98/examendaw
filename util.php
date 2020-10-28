<?php


	function conectar_bd()
	{
		$conexion_bd = mysqli_connect("sql3.freemysqlhosting.net", "sql3373124", "eyS1Bz9DlG", "sql3373124");
        
		if($conexion_bd == NULL)
			die("La base de datos aun no esta disponible intenta mas tarded");
		
		$conexion_bd->set_charset("utf8");	
        
		return $conexion_bd;
	}

	
	function desconectar_bd($conexion_bd)
	{
		mysqli_close($conexion_bd);
	}





 function select($id, $asmr, $tabla, $ele=0) {
        
        $conexion_bd = conectar_bd();
        
        $resultado = '<div id='.$tabla.'><select name="'.$tabla.'" required><option disabled selected>Selecciona una opción</option>';
                
        $consulta = "SELECT $id, $asmr FROM $tabla";
        
        $resultados = $conexion_bd->query($consulta);
        
        while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
            
            $resultado .= '<option value="'.$row["$id"].'" ';
            
            if($ele == $row["$id"]) {
                
                $resultado .= 'selected';
            }
            
            $resultado .= '>'.$row["$asmr"].'</option>';
        }
            
        
        $resultado .=  '</select></div>';
        
        return $resultado;
    }





    function getZombie($idNombre=""){
        
        $con = conectar_bd();
        
        $con->set_charset("utf8");
        
       $sql = "SELECT  DATE_FORMAT(R.fecha,\"%d/%m/%Y\") as fecha, R.fecha as fechaC, DATE_FORMAT(R.fecha,\"%H:%i:%s\") as hora, N.nombre as nombre, E.nombre as incidente 
              
                FROM Registro as R ,EstadoActual as E, Nombre as N
                
                Where R.idNombre = N.id and R.idEstadoActual = E.id";
                
        
        if($idNombre != ""){
            
            $sql .= " and R.idNombre = $idNombre";
        }

        $sql .=" ORDER  BY  fechaC  DESC";
        
        $result = mysqli_query($con, $sql);
        
        $tabla = "<hr>";
        
        if(mysqli_num_rows($result)){
            
            $tabla .= "<table class=\"highlight centered\">";
            
            $tabla .= "<thead>
            
            <tr>
            <th>Nombre</th>
            <th>Tipo de incidente</th>
            <th>Fecha</th>
            <th>Hora</th>
            </tr>
            </thead>";
            
            while($row = mysqli_fetch_assoc($result)){   
                
                $tabla .= "<tr>";
                $tabla .= "<td>". $row["nombre"]. "</td>"; 
                $tabla .= "<td>". $row["incidente"]. "</td>"; 
              
                $tabla .= "<td>". $row["fecha"]. "</td>";
                $tabla .= "<td>". $row["hora"]. "</td>";
                $tabla .= "</tr>";
            }
            
            $tabla .= "</table>";
            }
            else{

                
                 $tabla .= "
             
                      <div class=\"card blue\">
                          <div class=\"card-content white-text\">
                              <span class=\"card-title\">No hay nada.</span>
                          </div>
                      </div>
                
                  ";
                
            }
        
       
        
        return $tabla;
    }
    
    

?>