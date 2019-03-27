<?php
/**
 * Conexion con la base de datos
 */
define('DEFAULT_CHARSET','utf8'); // iso-8859-1 utf-8
define('DB_SERVER','localhost');
define('DB_SERVER_USERNAME','json-imagen');
define('DB_SERVER_PASSWORD','json-imagen');
define('DB_DATABASE','json-imagen');
if( !($db_link = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE.';charset=utf8', DB_SERVER_USERNAME, DB_SERVER_PASSWORD)) )
{
  	echo "Could not connect to ".DB_DATABASE."<br>";
  	return true;
}
/**
 * [sql_select description]
 * @param  [type]  $query     [description]
 * @param  [type]  $rv        [description]
 * @param  boolean $reemplazo [description]
 * @param  integer $cantidad  [description]
 * @return [type]             [description]
 */
function sql_select( $query, &$rv, $reemplazo = true, $cantidad = 0 )
{
  	global $db_link;
    if( $reemplazo )
    {
        $query = preg_replace("/\r\n|\r/", chr(32), $query);
    }
  	if( DEFAULT_CHARSET == "utf8" OR DEFAULT_CHARSET == "utf-8" )
  	{
        $db_link->query("SET NAMES 'utf8'");
  	}
  	$rv = $db_link->prepare( $query );
  	if( !$rv->execute() )
  	{
		return false;
  	}
  	if( $last_id = $db_link->lastInsertId() )
  	{
        return $last_id;
  	}
  	return true;
}
?>
