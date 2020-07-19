# Signin-Signup-using-Codeigniter
Complete user registration and login system using Codeigniter

This repository contains the code files for Simple authentication mechanism using Codeignitor 3.1.1 with
1. Registration/Signup
2. Login/Signin
3. Verifing the email
4. Reset password

The database is present in the folder named **'database'**.

version of the packages used:

1. Codeigniter-3.1.1
2. Xampp-7.4.5
3. Apache-2.4.43
4. MariaDB-10.4.11

Files contained with functions:
Controller
1. Register.php
    - validation() for form-validation and sending email verification mail.
	 - verify_email() for verifying email.
2. Login.php
    - validation() for form-validation and log in to the account.
		- The home page after login shows welcome message and logout button.
	 - forgot_validation() for sending email for reset password.
	   - 'token' variable will contain random 8 digit number that will be sent in email for reset password request.
	 - reset() to reset the password.
	 - updatepass() for updating password in the database.
	 
Models
1. Register_model.php
   - insert() for inserting data in database,
2. Login_model.php
   - can_login() for signin.

Views
1. register.php - Registration form.
2. login.php - Login form.
3. forgot_password_form.php - Entering email id for reset password request.(If email id is registered).
4. resetpass_form.php - Entering new password and confirm it.
5. email_verification.php - For verifying email.
