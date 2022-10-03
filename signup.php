<?php include 'conn.php' ?>
<body>


		<?php 


			
			$msgErr=$msg =  "";
			if (isset($_POST['submit'])) {
				$msgErr=$msg = "";
				$name = $_POST['name'];
				$age = $_POST['age'];
				if(isset($_POST['gender'])){
					$gender = $_POST['gender'];
				}
				
				$pin = $_POST['pin'];
				$re_pin = $_POST['repeat_pin'];
				$uploadOk = 1;
				
				if(empty($_FILES['pic']['name'])){
					$img = "Capture.png";
				}else{
					$img = $_FILES['pic']['name'];
				}
				$target = "imgs/upload/".basename($_FILES['pic']['name']);
				//$imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));

				/*
				// Check file size
				if ($_FILES["pic"]["size"] > 500000) {
					$msgErr .=  "<div class='alert alert-danger'>Sorry, your file is too large.</div>";
					$uploadOk = 0;
				}*/
				
				/*
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					$msgErr .= "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
					$uploadOk = 0;
				}
				*/
				//moving uploaded pic

				
				

				if(empty($name) || empty($pin)){

					$msgErr .= "<div class='alert alert-danger'>Name and Password is Empty</div>";
				}else{
				
				$exist = mysqli_query($conn,"SELECT * FROM users WHERE user_name = '$name' AND password = '$pin'");

				if (mysqli_num_rows($exist) >= 1) {
					$msgErr .= "<div class='alert alert-danger'>Data already exist, use other data</div>";
				}else{

					if ($pin == $re_pin || $uploadOk == 1) {
						
						move_uploaded_file($_FILES['pic']['tmp_name'], $target);
						// insert into users
						$ins = mysqli_query($conn,"INSERT INTO users(user_name,user_img,user_age,gender,password) VALUES('$name','$img','$age','$gender','$pin')");




						if (!$ins) {
							$msgErr .= "Error to create account: ".mysqli_error($conn);
						}else{
							$msg.= "<div class='alert alert-success'>Account Created. Make login</div>";
						}
						
						
					}else{
						$msgErr .= "<div class='alert alert-danger'>Password Not match</div>";
					}
					
				}
			}

			
		}


		?>


	<section class="section_sign_in">
		<div class="sign_in_form">
			<div class="container">
				<div class="row">
					<div class="col-md-6 p-5 ">
						<img src="imgs/brand.jpg " class="img-fluid ">
					</div>
					<div class="col-md-6 frm-color p-5 ">
		
						<h1>Sign Up</h1>
						<p >Please fill in this rm to create an account.</p>

						<div class="mesages">
								<span><?php echo $msgErr ?></span>
								<span><?php echo $msg ?></span>
						</div>
						
						<form method="POST" action="signup.php" enctype="multipart/form-data">
							<div class="cont">
								<div class="elem1 elm" id="elm1">
									<label><h4>UserName</h4></label> <br> 
									<input type="text" name="name" placeholder="Enter Email / Phone number">

									<label><h4>Password</h4></label> <br> 
									<input type="password" name="pin" placeholder="Password" >


									<label><h4>Repeat Password</h4></label> <br> 
									<input type="password" name="repeat_pin" placeholder="Repeat Password" > <br> <br>
									<a href="#" class="btn btn-success" id="next">Next</a>
								</div>
								<div class="elem2 elm" id="elm2">
									<label><h4>Enter Picture</h4></label> <br> 
									<input type="file" name="pic"><br><br>

									<label><h4>Age</h4></label> <br> 
									<input type="number" name="age" placeholder="Enter Your Age" ><br><br>

									<label><h4>Gender</h4></label> <br> 
									<input type="radio" name="gender" value="Male"> Male
									<input type="radio" name="gender" value="Female"> Female <br>
									<a href="#" class="btn btn-success" id="prev">prev</a>
									<input type="submit" name="submit" value="Sign Up" class="submit">
								</div>
							</div>
							


							
						</form>
						<a href="index.php" class="mt-3 ">Make Login</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		var next = document.getElementById("next");
		var prev = document.getElementById("prev");

		var elm1 = document.getElementById("elm1");
		var elm2 = document.getElementById("elm2");

		next.addEventListener("click",function(){
			elm1.style.left = "-450px";
			elm2.style.left = "30px";
		});
		prev.addEventListener("click",function(){
			elm1.style.left = "30px";
			elm2.style.left = "450px";
		});

	</script>




<?php include 'links.php'?>