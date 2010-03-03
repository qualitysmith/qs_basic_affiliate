<? include( 'include/functions.php' ); ?>
<? $page_title = "Customer Information"; ?>
<? include( 'include/header.php' ); ?>

<h4>Customer Information</h4>
<form action="thankyou.php" method="post">
	<?= projectDetailsFields() ?>
	<?= tradeField() ?>
	<div>
		<label for="data[FirstName]">First Name:</label>
		<input type="text" name="data[FirstName]" />
	</div>
	<div>
		<label for="data[LastName]">Last Name:</label>
		<input type="text" name="data[LastName]" />
	</div>
	<div>
		<label for="data[AddressLine1]">Street Address:</label>
		<input type="text" name="data[AddressLine1]" />
	</div>
	<div>
		<label for="data[City]">City:</label>
		<input type="text" name="data[City]" />
	</div>
	<div>
		<label for="data[State]">State:</label>
		<select name="data[State]">
			<option value="AL">Alabama</option> 
			<option value="AK">Alaska</option> 
			<option value="AZ">Arizona</option> 
			<option value="AR">Arkansas</option> 
			<option value="CA">California</option> 
			<option value="CO">Colorado</option> 
			<option value="CT">Connecticut</option> 
			<option value="DE">Delaware</option> 
			<option value="DC">District Of Columbia</option> 
			<option value="FL">Florida</option> 
			<option value="GA">Georgia</option> 
			<option value="HI">Hawaii</option> 
			<option value="ID">Idaho</option> 
			<option value="IL">Illinois</option> 
			<option value="IN">Indiana</option> 
			<option value="IA">Iowa</option> 
			<option value="KS">Kansas</option> 
			<option value="KY">Kentucky</option> 
			<option value="LA">Louisiana</option> 
			<option value="ME">Maine</option> 
			<option value="MD">Maryland</option> 
			<option value="MA">Massachusetts</option> 
			<option value="MI">Michigan</option> 
			<option value="MN">Minnesota</option> 
			<option value="MS">Mississippi</option> 
			<option value="MO">Missouri</option> 
			<option value="MT">Montana</option> 
			<option value="NE">Nebraska</option> 
			<option value="NV">Nevada</option> 
			<option value="NH">New Hampshire</option> 
			<option value="NJ">New Jersey</option> 
			<option value="NM">New Mexico</option> 
			<option value="NY">New York</option> 
			<option value="NC">North Carolina</option> 
			<option value="ND">North Dakota</option> 
			<option value="OH">Ohio</option> 
			<option value="OK">Oklahoma</option> 
			<option value="OR">Oregon</option> 
			<option value="PA">Pennsylvania</option> 
			<option value="RI">Rhode Island</option> 
			<option value="SC">South Carolina</option> 
			<option value="SD">South Dakota</option> 
			<option value="TN">Tennessee</option> 
			<option value="TX">Texas</option> 
			<option value="UT">Utah</option> 
			<option value="VT">Vermont</option> 
			<option value="VA">Virginia</option> 
			<option value="WA">Washington</option> 
			<option value="WV">West Virginia</option> 
			<option value="WI">Wisconsin</option> 
			<option value="WY">Wyoming</option>
		</select>
	</div>
	<div>
		<label for="data[Zip]">Zip:</label>
		<input type="text" name="data[Zip]" />
	</div>
	<div>
		<label for="data[Phone]">Phone:</label>
		<input type="text" name="data[Phone]" />
	</div>
	<div>
		<label for="data[AlternatePhone]">Alternate Phone:</label>
		<input type="text" name="data[AlternatePhone]" />
	</div>
	<div>
		<label for="data[Email]">Email:</label>
		<input type="text" name="data[Email]" />
	</div>

	<input type="submit" value="Continue" />
</form>

<? include( 'include/footer.php' ); ?>
