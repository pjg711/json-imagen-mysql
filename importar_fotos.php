<?php
/**
 * Este script toma la tabla de recursos guardados en campo blob
 * y los pasa a la tabla con el campo json
 */
include "conector.php";
$idiomas = ["1" => "es", "2" => "in", "3" => "fr"];
$tabla_origen = "cifasis_fotos";
$tabla_destino = "resumenes";
$area = "recursos";
$componente = "perfil";
$query = "SELECT * FROM `{$tabla_origen}`";
if( sql_select( $query, $consulta ) )
{
    while( $row = $consulta->fetch(\PDO::FETCH_ASSOC) )
    {
        $config_foto = $row['config_foto'];
        if( $config_foto != "" )
        {
            $id_foto = $row['id_foto'];
            $id_persona = $row['id_persona'];
            $activo = $row['activo'];
            $tipo = $row['archivo_tipo'];
            $contenido = base64_encode( $row['foto'] );
            $peso = strlen( $contenido );
            $id_persona = $row['id_persona'];
            $hash_contenido = md5( $contenido );
            $nue = [];
            $nue['id_foto'] = $id_foto;
            $nue['id_persona'] = $id_persona;
            $nue['archivo'] = $config_foto;
            $nue['tipo'] = $tipo;
            $nue['peso'] = $peso;
            $nue['contenido'] = $contenido;
            $nue['id_persona'] = $id_persona;
            $nue['hash_contenido'] = $hash_contenido;
            $nue['activo'] = $activo;
            $cadena_json = addslashes(json_encode( $nue ));
            $query = "INSERT INTO `{$tabla_destino}` (id_idioma,area,componente,resumen) VALUES (0,'{$area}','{$componente}','{$cadena_json}')";
            if( sql_select( $query, $consulta2 ) )
            {
                echo "bien!";
            }else
            {
                echo "---->MAL!";
            }
            echo "\n";
        }
    }
}
?>
