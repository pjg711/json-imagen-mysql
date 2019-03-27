<?php
// https://scotch.io/tutorials/working-with-json-in-mysql
/**
 * este script lee las imagenes png de una carpeta
 * y las guarda en un campo json de mysql
 */
include "config.php";
$dir = "/home/pablo/Imágenes/";
$tipo = "image/png";
$extension = "png";
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
                    "peso" => strlen($imageData),
                    "contenido" => $imageData
                ];
                $cadena_json = addslashes(json_encode( $row ));
                $query = "INSERT INTO resumenes (resumen) VALUES ('{$cadena_json}')";
                echo "file--->{$file2}\n";
                if( sql_select( $query, $consulta ) )
                {
                    echo "bien!\n";
                }else
                {
                    echo "mal!\n";
                }
            }
        }
        closedir($dh);
    }
}
?>
