<?php
/**
 * Este script toma la tabla de recursos guardados en campo blob
 * y los pasa a la tabla con el campo json
 */
include "conector.php";
$idiomas = ["1" => "es", "2" => "in", "3" => "fr"];
$tabla_origen = "cifasis_recursos_archivos";
$tabla_destino = "resumenes";
$area = "recursos";
$query = "SELECT * FROM `{$tabla_origen}`";
if( sql_select( $query, $consulta ) )
{
    while( $row = $consulta->fetch(\PDO::FETCH_ASSOC) )
    {
        $nombre = $row['archivo_nombre'];
        if( $nombre != "" )
        {
            $id_archivo = $row['id_archivo'];
            $contenido = base64_encode( $row['archivo'] );
            $tipo = $row['archivo_tipo'];
            $peso = strlen( $contenido );
            $componente = $row['componente'];
            $id_persona = $row['id_persona'];
            $id_grupo = $row['id_grupo'];
            $config_archivo = $row['config_archivo'];
            $timecreated = $row['timecreated'];
            $timemodified = $row['timemodified'];
            $hash_nombre = md5( $row['hash_nombre'] );
            $hash_contenido = md5( $contenido );
            $hash_path_completo = $hash_nombre;
            $titulo = $row['titulo_es'];
            $comentario = $row['comentario_es'];
            $id_contexto = $row['id_contexto'];
            $activo = $row['activo'];
            $nue = [];
            $nue['id_archivo'] = $id_archivo;
            $nue['archivo'] = $nombre;
            $nue['archivo2'] = $nombre;
            $nue['tipo'] = $tipo;
            $nue['peso'] = $peso;
            $nue['contenido'] = $contenido;
            $nue['id_persona'] = $id_persona;
            $nue['id_grupo'] = $id_grupo;
            $nue['config_archivo'] = $config_archivo;
            $nue['timecreated'] = $timecreated;
            $nue['timemodified'] = $timemodified;
            $nue['hash_nombre'] = $hash_nombre;
            $nue['hash_contenido'] = $hash_contenido;
            $nue['hash_path_completo'] = $hash_path_completo;
            foreach( $idiomas as $key_idioma => $idioma )
            {
                $nue['titulo'][$key_idioma] = $row['titulo_'.$idioma];
                $nue['comentario'][$key_idioma] = $row['comentario_'.$idioma];
            }
            $nue['id_contexto'] = $id_contexto;
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
