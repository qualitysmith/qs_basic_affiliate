<? $page_title = "Heating"; ?>
<? include( 'include/header.php' ); ?>

<script type="text/javascript">
<!--
	var systemType = Array();
	systemType["Heating"] = Array(
		"Furnace",
		"Boiler",
		"Radiant Floor",
		"Baseboard",
		"Geothermal",
		"Heat Pump"
	);
	systemType["Cooling"] = Array(
		"A/C",
		"Heat Pump"
	);
	systemType["Both"] = Array(
		"Furnace",
		"Boiler",
		"A/C",
		"Radiant Floor",
		"Baseboard",
		"Geothermal",
		"Heat Pump"
	);

	function changeSystemType() {
		systemTypeSelect().empty();
		addSystemTypeOptions();
	}

	function addSystemTypeOptions() {
		$(systemType[baseTypeSelect().val()]).map( function( index, name ) {
			systemTypeSelect().append( "<option>" + name + "</option>" );
		} );	
	}

	function systemTypeSelect() {
		return $('#SystemType select');
	}

	function baseTypeSelect() {
		return $('#BaseType select');
	}

	$(document).ready(function(){
		changeSystemType();
		baseTypeSelect().change( changeSystemType );
	});
//-->
</script>

<h4>Heating</h4>
<form action="customer_information.php" method="post">
	<input type="hidden" name="data[Trade]" value="HVAC" />
	<div id="BaseType">
		<label for="details[Heating Or Cooling]">What type of system:</label>
		<select name="details[Heating Or Cooling]">
			<option>Heating</option>
			<option>Cooling</option>
			<option>Both</option>
		</select>
	</div>
	<div id="SystemType">
		<label for="details[System Type]">Specific:</label>
		<select name="details[System Type]">
		</select>
	</div>
	<div>
		<label for="details[Currently Functioning]">Is your system currenlty functioning?:</label>
		<input type="radio" name="details[Currently Functioning]" value="Yes" CHECKED /> Yes
		<input type="radio" name="details[Currently Functioning]" value="No" /> No
	</div>
	<div>
		<label for="details[Homeowner]">Are you the homeowner?<label>
		<input type="radio" name="details[Homeowner]" value="Yes" CHECKED /> Yes
		<input type="radio" name="details[Homeowner]" value="No" /> No
	</div>

	<input type="submit" value="Continue" />
</form>

<? include( 'include/footer.php' ); ?>
