<?
$database_connection = NULL;
function connectToDatabase() {
	global $DatabaseHost, $DatabasePort, $DatabaseName, $DatabaseUser, $DatabasePassword;
	global $database_connection;

	$connect_string = "host=$DatabaseHost port=$DatabasePort dbname=$DatabaseName user=$DatabaseUser password=$DatabasePassword";
	$database_connection = pg_connect( $connect_string ) or die('connection failed');
}

function dbInsert( $table_name, $assoc_array ) {
	global $database_connection;
	$result = pg_insert( $database_connection, $table_name, $assoc_array );
	if( $result ) {
		return dbLastInsertId();
	} else {
		die("PG Error: " . pg_result_error($result));
	}
}

function dbUpdate( $table_name, $data, $id ) {
	global $database_connection;
	$result = pg_update( $database_connection, $table_name, $data, Array( 'id' => $id ) );
	if( !$result ) {
		die("PG Error: " . pg_result_error($result));
	}
}

function dbLastInsertId() {
	global $database_connection;
	$result = pg_query( $database_connection, "SELECT lastval();" );
	if( !$result ) {
		die("PG Error: " . pg_result_error($result));
	}
	$row = pg_fetch_row($result);
	return $row[0];
}
?>
