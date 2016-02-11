<?php
include "conector.php";
$where = "";
if( isset( $_GET['id'] ) )
{
    $id = $_GET['id'];
    $where = "id_resumen={$id}";
}
if( isset( $_GET['archivo'] ) )
{
    $archivo = $_GET['archivo'];
    $where = "JSON_EXTRACT(resumenes.`resumen`,'$.archivo') = '{$archivo}'";
}
if( isset( $_GET['hash'] ) )
{
    $hash_contenido = $_GET['hash'];
    $where = "JSON_EXTRACT(resumenes.`resumen`,'$.hash_contenido') = '{$hash_contenido}'";
}
$query = "SELECT id_resumen,resumen FROM `resumenes`";
if( $where != "" )
{
    $query .= " WHERE " . $where;
}
//echo "query--->{$query}<br>";
//exit;
if( @sql_select( $query, $consulta ) )
{
    $fotito = @$consulta->fetch(\PDO::FETCH_ASSOC);
    if( isset( $fotito["resumen"] ) )
    {
        $json = json_decode( $fotito["resumen"], true );
        $tipo = $json["tipo"];
        //$peso = $json["peso"];
        $contenido = base64_decode( $json["contenido"] );
        $peso = strlen($contenido);
        //echo "peso:{$peso}--->peso2:{$peso2}----<br>";
        header("Content-type: $tipo");
        header("Content-length: $peso");
        echo $contenido;
    }
}

?>
