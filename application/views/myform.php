<html>
<head>
<title>My Form</title>
</head>
<body>



<?php echo form_open(''); ?>
<h5>Username</h5>
<input type="text" name="name" value="<?php echo set_field_value('name'); ?>" size="50" />
<?php echo form_error('name'); ?>
<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_field_value('email'); ?>" size="50" />
<?php echo form_error('email'); ?>
<div><input type="submit" name="submit" value="<?php echo $action_btn; ?>" /></div>

</form>

</body>
</html>