<? include( 'include/functions.php' ); ?>
<? $page_title = "Customer Information"; ?>
<? include( 'include/header.php' ); ?>

<script type="text/javascript" src="validation.js"></script>

<h4>Customer Information</h4>
<form action="thankyou.php" method="post" onSubmit="return validate();">
	<?= projectDetailsFields() ?>
	<?= tradeField() ?>
	<div>
		<label for="data[FirstName]">First Name:</label>
		<input type="text" name="data[FirstName]" validate="presence" validateError="required" />
	</div>
	<div>
		<label for="data[LastName]">Last Name:</label>
		<input type="text" name="data[LastName]" validate="presence" validateError="required" />
	</div>
	<div>
		<label for="data[AddressLine1]">Street Address:</label>
		<input type="text" name="data[AddressLine1]" validate="presence" validateError="required" />
	</div>
	<div>
		<label for="data[Zip]">Zip:</label>
		<input type="text" name="data[Zip]" validateFormat="^\d{5}$" validateError="must be a 5 digit zip" />
	</div>
	<div>
		<label for="data[Phone]">Phone:</label>
		<input type="text" name="data[Phone]" validateFormat="^\d{10}$" validateError="must be a 10 digit phone number" />
	</div>
	<div>
		<label for="data[AlternatePhone]">Alternate Phone:</label>
		<input type="text" name="data[AlternatePhone]" validateFormat="^\d{10}$|^$" validateError="must be a 10 digit phone number" />
	</div>
	<div>
		<label for="data[Email]">Email:</label>
		<input type="text" name="data[Email]" validateFormat="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" validateError="must be a valid email" />
	</div>

	<input type="submit" value="Continue" />
</form>

<? include( 'include/footer.php' ); ?>
