<?php
/**
 * este script lee las imagenes png de una carpeta
 * y las guarda en un campo json de mysql.
 * https://scotch.io/tutorials/working-with-json-in-mysql
 */
include "conector.php";
$dir = "/home/pablo/Imágenes/";
$tipo = "image/png";
$extension = "png";
$area = "recursos";
$componente = "imagen";
// busco archivos
if( is_dir($dir) )
{
    if( $dh = opendir($dir) )
    {
        while( ($file = readdir($dh) ) !== false)
        {
            if( substr( $file, -3 ) == $extension )
            {
                $file2 = $dir . $file;
                $contenido = file_get_contents( $file2 );
                $imageData = base64_encode($contenido);
                $row = [
                    "archivo" => $file2,
                    "archivo2" => $file,
                    "tipo" => $tipo,
                    "peso" => strlen($contenido),
                    "contenido" => $imageData
                ];
                $cadena_json = addslashes(json_encode( $row ));
                $query = "INSERT INTO resumenes (area,componente,resumen) VALUES ('{$area}','{$componente}','{$cadena_json}')";
                echo "file--->{$file2}--->";
                if( sql_select( $query, $consulta ) )
                {
                    echo "bien!";
                }else
                {
                    echo "MAL!";
                }
                echo "\n";
            }
        }
        closedir($dh);
    }
}
?>
