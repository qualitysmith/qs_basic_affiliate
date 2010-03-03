<?
include( 'config.php' );
include( 'database.php' );

function projectDetailsFields() {
	$result = "";
	foreach( projectDetails() AS $key => $value ) {
		$escaped_value = htmlspecialchars($value);
		$result .= "<input type=\"hidden\" name=\"details[$key]\" value=\"$escaped_value\" />";
	}
	return $result;
}

function projectDetails() {
	if( isset($_REQUEST['details']) && is_array( $_REQUEST['details'] ) ) {
		return $_REQUEST['details'];
	} else {
		// FIXME: Error?
		return Array();
	}
}

function tradeField() {
	$trade = trade();
	return "<input type=\"hidden\" name=\"data[Trade]\" value=\"$trade\" />";
}

function data() {
	if( isset( $_REQUEST['data'] ) && is_array( $_REQUEST['data'] ) ) {
		return $_REQUEST['data'];
	} else {
		// FIXME: Error?
		return Array();
	}
}

function trade() {
	$data = data();
	return $data['Trade'];
}

function processPost() {
	connectToDatabase();
	$id = createInitialTask();
	$xml = generateXml($id);
	addRequestXml( $id, $xml );
	$response = postXml($xml);
	addResponse( $id, $response );
}

function now() {
	return date('Y-m-d H:i:s O');
}

function createInitialTask() {
	$data = data();
	$insert = Array(
		'trade' => trade(),
		'first_name' => $data['FirstName'],
		'last_name' => $data['LastName'],
		'address' => $data['AddressLine1'],
		'zip' => $data['Zip'],
		'phone' => $data['Phone'],
		'alternate_phone' => $data['AlternatePhone'],
		'email' => $data['Email'],
		'trade_questions' => json_encode( projectDetails() ),
		'created_at' => now(),
		'updated_at' => now()
	);
	return dbInsert( 'tasks', $insert );
}

function addRequestXml( $id, $xml ) {
	dbUpdate( 'tasks', Array( 'request_xml' => $xml, 'updated_at' => now() ), $id );
}

function addResponse( $id, $response ) {
	$success = parseResponse( $response );
	dbUpdate( 'tasks', Array( 'response_xml' => $response, 'accepted' => $success, 'updated_at' => now() ), $id );
}

function xmlHeader( $id ) {
	global $AffiliateName, $AffiliateCode;

	return "<LeadSet>
	<AffiliateName>$AffiliateName</AffiliateName>
	<AffiliateCode>$AffiliateCode</AffiliateCode>
	<Lead>
		<LeadID>$id</LeadID>\n";
}

function xmlFooter() {
	return "\t</Lead>
</LeadSet>";
}

function xmlentities ( $string )
{
	$search = Array( '&', '"', "'", '<', '>' );
	$replace = Array( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;' );
    return str_replace( $search, $replace, $string );
}

function baseDataXml() {
	if( isset( $_REQUEST['data'] ) && is_array( $_REQUEST['data'] ) ) {
		$xml = "";
		foreach( $_REQUEST['data'] AS $key => $value ) {
			if( trim($value) != '' ) {
				$escaped_value = xmlentities($value);
				$xml .= "\t\t<$key>$escaped_value</$key>\n";
			}
		}
		return $xml;
	} else {
		// FIXME: Error?
		return "";
	}
}

function projectDetailsXml() {
	if( isset($_REQUEST['details']) && is_array( $_REQUEST['details'] ) ) {
		$xml = "\t\t<ProjectDetails>\n";
		foreach( $_REQUEST['details'] AS $key => $value ) {
			if( trim($value) != '' ) {
				$xml .= "\t\t\t<Detail>\n";
				$xml .= "\t\t\t\t<Name>$key</Name>\n";
				$xml .= "\t\t\t\t<Value>$value</Value>\n";
				$xml .= "\t\t\t</Detail>\n";
			}
		}
		$xml .= "\t\t</ProjectDetails>\n";
		return $xml;
	} else {
		// FIXME: Error?
		return "";
	}
}

function generateXml( $id ) {
	$xml = xmlHeader( $id );
	$xml .= baseDataXml();
	$xml .= projectDetailsXml();
	$xml .= xmlFooter();
	return $xml;
}

function postXml( $xml ) {
	global $QualitySmithEndpoint;

	$options = Array( 'headers' => Array( 'Content-type' => 'text/xml' ) );
	$url = $QualitySmithEndpoint;
	$response = http_parse_message( http_post_data( $url, $xml, $options ) );
	return $response->body;
}

function parseResponse( $response ) {
	if( strpos($response, "<CompleteSuccess>true</CompleteSuccess>") === false ) {
		return false;
	} else {
		return true;
	}
}
?>
