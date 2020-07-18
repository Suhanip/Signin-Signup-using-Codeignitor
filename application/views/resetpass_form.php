<!DOCTYPE html>
<html>
<head>

	<title>Reset Password Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<br />
		<h3 align="center">Reset Password Form</h3>
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">Reset your password</div>
			<div class="panel-body">
				<?php
				if($this->session->flashdata('message'))
				{
					echo '
					<div class="alert alert-success">'.$this->session->flashdata("message").'</div>';
				} 
				?>
				
				<form method="post" action="<?php echo base_url();?>login/updatepass">

				
				<div class="form-group">
					<label>Enter Password</label>
					<input type="password" name="user_password" class="form-control" value="<?php echo set_value('user_password'); ?>" required/>
					<span class="text-danger"><?php echo form_error('user_password'); ?></span>
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" name="user_cpassword" class="form-control" value="<?php echo set_value('user_cpassword'); ?>" required/>
					<span class="text-danger"><?php echo form_error('user_cpassword'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" name="reset" value="Reset Password" class="btn btn-info" />
				</div>
				</form>

			</div>

	</div>










</body>
</html>