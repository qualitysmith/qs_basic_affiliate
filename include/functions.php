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
	// TODO: send xml
	// TODO: log transaction
}

function xmlHeader() {
	return "<LeadSet>
	<AffiliateName>Example Company</AffiliateName>
	<AffiliateCode>1b826051506f463f07307598fcf12fd6</AffiliateCode>
	<Lead>
		<LeadID>9485202</LeadID>\n";
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
?>
