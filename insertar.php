<?php
/**
 * Este script toma la tabla de recursos guardados en campo blob
 * y los pasa a la tabla con el campo json
 */
include "conector.php";
$area = "recursos";
//$componente = "foto";
$query = "SELECT * FROM `cifasis_recursos_archivos`";
if( sql_select( $query, $consulta ) )
{
    while( $row = $consulta->fetch(\PDO::FETCH_ASSOC) )
    {
        $id_archivo = $row['id_archivo'];
        $nombre = $row['archivo_nombre'];
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
        $contenido = $row['comentario_es'];
        $config_archivo = $row['config_archivo'];
        $id_contexto = $row['id_contexto'];
        $activo = $row['activo'];

        $nue = [];
        $nue = [
            "id_archivo" => $id_archivo,
            "archivo" => $nombre,
            "archivo2" => $nombre,
            "tipo" => $tipo,
            "peso" => $peso,
            "contenido" => $contenido,
            
        ]
    }
}
?>
