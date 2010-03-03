<?
function projectDetailsFields() {
	if( isset($_REQUEST['details']) && is_array( $_REQUEST['details'] ) ) {
		$result = "";
		foreach( $_REQUEST['details'] AS $key => $value ) {
			$escaped_value = htmlspecialchars($value);
			$result .= "<input type=\"hidden\" name=\"details[$key]\" value=\"$escaped_value\" />";
		}
		return $result;
	} else {
		// FIXME: Error?
		return "";
	}
}

function tradeField() {
	if( isset( $_REQUEST['data']['Trade'] ) ) {
		$trade = $_REQUEST['data']['Trade'];
		return "<input type=\"hidden\" name=\"data[Trade]\" value=\"$trade\" />";
	} else {
		// FIXME: Error?
		return "";
	}
}

function processPost() {
	$xml = generateXml();
	$response = postXml($xml);
	var_dump( $response );
	if( parseResponse( $response ) ) {
		// TODO: log success transaction
	} else {
		// TODO: log failure transaction
	}
}

function xmlHeader() {
	return "<LeadSet>
	<AffiliateName></AffiliateName>
	<AffiliateCode></AffiliateCode>
	<Lead>
		<LeadID></LeadID>\n"; // FIXME: set a unique LeadID
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
			$escaped_value = xmlentities($value);
			$xml .= "\t\t<$key>$escaped_value</$key>\n";
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
			$xml .= "\t\t\t<Detail>\n";
			$xml .= "\t\t\t\t<Name>$key</Name>\n";
			$xml .= "\t\t\t\t<Value>$value</Value>\n";
			$xml .= "\t\t\t</Detail>\n";
		}
		$xml .= "\t\t</ProjectDetails>\n";
		return $xml;
	} else {
		// FIXME: Error?
		return "";
	}
}

function generateXml() {
	$xml = xmlHeader();
	$xml .= baseDataXml();
	$xml .= projectDetailsXml();
	$xml .= xmlFooter();
	return $xml;
}

function postXml( $xml ) {
	$options = Array( 'headers' => Array( 'Content-type' => 'text/xml' ) );
	$url = "http://www.qualitysmith.com/affiliates/incoming/incoming_leads_test.php";
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
