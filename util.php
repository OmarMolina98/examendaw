<?php

    function conectar_bd() {
        
        $conexion_bd = mysqli_connect("sql3.freemysqlhosting.net","sql3373124","eyS1Bz9DlG","sql3373124");
        if ($conexion_bd == NULL) {
            die("No se pudo conectar con la base de datos");
        }
        return $conexion_bd;
    }

    function cerrar_bd($conexion_bd) {
        
        mysqli_close($conexion_bd);
    }

    function cleamData ($dataToCleam){
        
        return stripslashes(trim(htmlspecialchars($dataToCleam)));
    }

    function getIncidentes($idLugar=""){
        
        $con = conectar_bd();
        
        $con->set_charset("utf8");
        
        $sql = "SELECT  DATE_FORMAT(S.fecha,\"%d/%m/%Y\") as fecha, S.fecha as fechaC, DATE_FORMAT(S.fecha,\"%H:%i:%s\") as hora, L.nombre as lugar, T.nombre as tipo 
                FROM IncidenteSeguridad as S ,IncidenteTipo as T, Lugares as L 
                Where S.idLugares = L.id and S.idIncidenteTipo = T.id "; 
        
        if($idLugar != ""){
            
            $sql .= " and S.idLugares = $idLugar";
        }

        $sql .=" ORDER  BY  fechaC  DESC";
        
        $result = mysqli_query($con, $sql);
        
        $tabla = "<hr>";
        
        if(mysqli_num_rows($result)){
            
            $tabla .= "<table class=\"highlight centered\">";
            
            $tabla .= "<thead>
            
            <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Tipo de incidente</th>
            </tr>
            </thead>";
            
            while($row = mysqli_fetch_assoc($result)){   
                
                $tabla .= "<tr>";
                $tabla .= "<td>". $row["fecha"]. "</td>";
                $tabla .= "<td>". $row["hora"]. "</td>";
                $tabla .= "<td>". $row["lugar"]. "</td>"; 
                $tabla .= "<td>". $row["tipo"]. "</td>"; 
                $tabla .= "</tr>";
            }
            
            $tabla .= "</table>";
            }
            else{

                  $tabla .= "
                  <div class=\"row\">
                  <div class=\"col s12 m12 l12\">
                      <div class=\"card blue lighten-1\">
                          <div class=\"card-content white-text\">
                              <span class=\"card-title\">No se encontró ningún resultado.</span>
                          </div>
                      </div>
                  </div>
              </div>
                  ";
            }
        
        cerrar_bd($con);
        
        return $tabla;
    }

    //segunda hoja

    function crear_select($id, $columna_descripcion, $tabla, $seleccion=0) {
        
        $conexion_bd = conectar_bd();
        
        $conexion_bd->set_charset("utf8");
        
        $resultado = '<div id='.$tabla.'><select name="'.$tabla.'" required><option  disabled selected>Selecciona una opción</option>';
                
        $consulta = "SELECT $id, $columna_descripcion FROM $tabla";
        
        $resultados = $conexion_bd->query($consulta);
        
        while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
            
            $resultado .= '<option value="'.$row["$id"].'" ';
            
            if($seleccion == $row["$id"]) {
                
                $resultado .= 'selected';
            }
            
            $resultado .= '>'.$row["$columna_descripcion"].'</option>';
        }
            
        cerrar_bd($conexion_bd);
        
        $resultado .=  '</select></div>';
        
        return $resultado;
    }

    function insertarIncidente($lugar,$tipo) {
        
        $conexion_bd = conectar_bd();
        
        $conexion_bd->set_charset("utf8");
        
        //Prepara la consulta
        
        $dml = 'INSERT INTO IncidenteSeguridad (idLugares, idIncidenteTipo) VALUES (?,?)';
        
        if ( !($statement = $conexion_bd->prepare($dml)) ) {
            die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
            return 0;
        }
        //Unir los parámetros de la función con los parámetros de la consulta   
        //El primer argumento de bind_param es el formato de cada parámetro
        
        if (!$statement->bind_param("ii", $lugar,$tipo)) {
            die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
            return 0;
        } 
        //Executar la consulta
        
        if (!$statement->execute()) {
          die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
            return 0;
        }
        
        cerrar_bd($conexion_bd);
        
          return 1;
      }


?>