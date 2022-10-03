<?php include 'conn.php'; ?>

<?php

if (!isset($_SESSION['name'])) {
	header("index.php");
}else{
	$_SESSION['user_id'];
	$_SESSION['name'];
}

 ?>
<?php 	$user_id = $_SESSION['user_id']; ?>


<div class="d-flex flex-wrap">
	<div class=" sect-1 p-0">
		<form id="form" class="pt-3 input-group search">
			<input type="text" id="input" class="form-control" placeholder="Search User">
			<input type="hidden"  id="u_id" value="<?php echo $user_id ?>">
			<input type="submit" name="search" value="Search" class="btn btn-success">
		</form>

	<div id="users">
		<?php
			$fetch = mysqli_query($conn,"SELECT * FROM users WHERE user_id != '$user_id'");


			if (!$fetch) {
				echo "ERROR: ".mysqli_error($fetch);
			}
			while($row = mysqli_fetch_array($fetch)){

				?>

								<a class="user" href="?rec_id=<?php echo $row['user_id'] ?>" >
									<div class=" u_img">
										<img src="imgs/capture.png">
									</div>
									<div class="text">

											<?php
												echo $row['user_name'];
											?>

										<!--<span class="time">1 hour ago</span>-->

									</div>

								</a>



				<?php
			}

		 ?>
	</div>

		 <div id="demo"></div>
	</div>
	<div class="sect_2 flex-grow-1">
		<div class="">
			<?php include 'nav.php'; ?>
		</div>


		<div class="tabs">
      <div class="tab_head">
      		<?php
						if ($_GET['rec_id']) {
							// code...
						}

					 ?>
      </div>
		</div>
	</div>
</div>




	 <script type="text/javascript">


	 //script for searching the user
	 	document.getElementById("form").addEventListener("keyup",myFunct);
	 	function myFunct(e){
	 		e.preventDefault();


	 		//declare all needed variable
	 		var input = document.getElementById("input").value;


	 		//hide default block of users
	 		var users = document.getElementById("users");
	 		if (input != "") {
	 			users.style.display = "none";
			}else{
	 			users.style.display = "block";

			}

	 		var id = document.getElementById("u_id").value;
	 		var xhr = new XMLHttpRequest();

	 		var parms = "user=" + input + "&u_id=" + id;

	 		xhr.open("POST","u_fetch.php",true);
	 		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	 		//take input name and it's values



	 		xhr.onload = function(){
	 			if (this.status == 200) {
	 				document.getElementById("demo").innerHTML = this.responseText;
	 			}
	 		}

	 		xhr.send(parms);

	 	}


		// code for displaying user chat section_sign_in




	 </script>

<?php include 'links.php' ?>
