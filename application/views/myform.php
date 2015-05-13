<html>
<head>
<title>My Form</title>
</head>
<body>



<?php echo form_open('admin/table/edit/1'); ?>

<h5>dropdown</h5>
<?php 
$options = array(
                  ''  => 'select',
                  'med'    => 'Medium Shirt',
                  'large'   => 'Large Shirt',
                  'xlarge' => 'Extra Large Shirt',
                );


echo form_dropdown('shirts', $options, set_field_value('shirts'));
echo form_error('shirts');
?>
<h5>Username</h5>
<?php 
$data = array(
              'name'        => 'username1',
              'value'       => set_field_value('username1'),
              'size'        => '50',
            );

echo form_input($data);

?>
<?php echo form_error('username1'); ?>
<h5>Username</h5>
<input type="text" name="username" value="<?php echo set_field_value('username'); ?>" size="50" />
<?php echo form_error('username'); ?>
<h5>Password</h5>
<input type="text" name="password" value="<?php echo set_field_value('password'); ?>" size="50" />
<?php echo form_error('passconf'); ?>
<h5>Password Confirm</h5>
<input type="text" name="passconf" value="<?php echo set_field_value('passconf'); ?>" size="50" />
<?php echo form_error('passconf'); ?>
<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_field_value('email'); ?>" size="50" />
<?php echo form_error('email'); ?>
<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>