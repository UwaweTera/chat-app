


<?php include 'conn.php' ?>
<body>

	<?php 	

		$msgErr=$msg =  "";
		if (isset($_POST['login'])) {
			// take input value
			$name = $_POST['name'];
			$pin = $_POST['pin'];

			$select = "SELECT * FROM users WHERE user_name = '$name' AND password = '$pin'";

			$query = mysqli_query($conn,$select);


			if (mysqli_num_rows($query) >= 1) {
				while($row = mysqli_fetch_array($query)){
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['name'] = $name;
					$_SESSION['pin'] = $pin;
				}

				header("location:home.php");
			}else{
				$msgErr .= "<div class='alert alert-danger'>Unknown Data, Try to signUp</div>";
			}
		}



	 ?>

	<section class="section_sign_in">
		<div class="sign_in_form">
			<div class="container">
				<div class="row">
					<div class="col-md-6 p-5 ">
						<img src="imgs/brand.jpg" class="img-fluid ">
					</div>
					<div class="col-md-6 frm-color p-5 ">
						<h1>Login</h1>
						<p >Please fill in this form to make Login.</p>
						<div class="mesages">
								<span><?php echo $msgErr ?></span>
						</div>

						<form method="POST" action="index.php">
							<label><h4>UserName</h4></label> <br>
							<input type="text" name="name" placeholder="Enter Email / Phone number" required>

							<label><h4>Password</h4></label> <br>
							<input type="password" name="pin" placeholder="Password" required>

							<input type="submit" name="login" value="Login" class="mt-3 mb-2">
						</form>

						<a href="signup.php" class="mt-3">Create Account</a>
					</div>
				</div>
			</div>
		</div>
	</section>








	<?php include 'links.php' ?>
</body>
</html>
