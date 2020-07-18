<!DOCTYPE html>
<html>
<head>

	<title>Forgot Password Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<br />
		<h3 align="center">Forgot Password Form</h3>
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">Don't remeber your password???</div>
			<div class="panel-body">
				<?php
				if($this->session->flashdata('message'))
				{
					echo '
					<div class="alert alert-success">'.$this->session->flashdata("message").'</div>';
				} 
				?>
				<form method="post" action="<?php echo base_url();?>login/forgot_validation">

				
				<div class="form-group">
					<label>Enter Email Address</label>
					<input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required/>
					<span class="text-danger"><?php echo form_error('email'); ?></span>

				</div>
				<div class="form-group">
					<input type="submit" name="forgot" value="Submit" class="btn btn-info" />
				</div>
				</form>

			</div>

	</div>










</body>
</html>