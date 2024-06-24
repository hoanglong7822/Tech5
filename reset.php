<!DOCTYPE html>
<html>
	<head>
		<title>!!!Đổi mật khẩu!!!</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="reset.css"/>
	</head>

<body>
	<!-- Form Open -->
	<fieldset>
		<legend>!!!Đổi mật khẩu!!!</legend>
		<!-- Include PHP Script -->
		<?php 
        include 'resetpass.php';
        ?>
		
		<form method="post">
			<dl>
				<dt>
					Nhập id
				</dt>
					<dd>
						<input type="text" name="id" placeholder="Enter id..." value="" required />
					</dd>
			</dl>
			
			<dl>
				<dt>
					Nhập mật khẩu mới
				</dt>
					<dd>
						<input type="password" name="new_pass" placeholder="Enter New Password..." value=""  required />
					</dd>
			</dl>
			
			<dl>
				<dt>
					Nhập lại mật khẩu mới
				</dt>
					<dd>
						<input type="password" name="re_pass" placeholder="Retype New Password..." value="" required />
					</dd>
			</dl>
			
			<p align="center">
				<input type="submit" class="btn" value="Reset Password" name="re_password" />
			</p>
		</form>
	</fieldset>
	<!-- Form Close -->
	
</body>
</html>