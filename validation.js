function validate() {
	var ok = validatePresenceFields();
	ok = validateFormatFields() && ok;
	return ok;
}

function validateFormatFields() {
	var ok = true;
	$('input[validateFormat]').each( function( index, field ) {
		ok = validateFormat( field ) && ok;
	} );
	return ok;
}

function validateFormat( field ) {
	clearError( field );
	if( RegExp( $(field).attr('validateFormat') ).test( field.value ) ) {
		return true;
	} else {
		setError( field );
		return false;
	}
}

function validatePresenceFields() {
	var ok = true;
	$('input[validate=presence]').each( function( index, field ) {
		ok = validatePresence( field ) && ok;
	} );
	return ok;
}

function validatePresence( field ) {
	clearError( field );
	if( RegExp("[^\w]").test( field.value ) ) {
		return true;
	} else {
		setError( field );
		return false;
	}
}

function clearError( field ) {
	$(field).removeClass('error');
	$(field).next('span.error').remove();
}

function setError( field ) {
	$(field).addClass('error');
	$(field).after('<span class="error">' + $(field).attr('validateError') + '</span>');
}
