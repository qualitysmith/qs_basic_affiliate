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
		<label for="data[AddressLine1]">Address Line 1:</label>
		<input type="text" name="data[AddressLine1]" />
	</div>
	<div>
		<label for="data[City]">City:</label>
		<input type="text" name="data[City]" />
	</div>
	<div>
		<label for="data[State]">State:</label>
		<input type="text" name="data[State]" />
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
