<?php include 'conn.php'; ?>

<?php
if (isset($_POST['logout'])) {
	$up = mysqli_query($conn, "UPDATE users SET status = 'off' WHERE user_id = '$_SESSION[user_id]'");
	session_destroy();
	session_unset();
	header("location:index.php");
}

if (!isset($_SESSION['name'])) {
	header("location:index.php");
}else{
	$_SESSION['user_id'];
	$_SESSION['name'];

	$up = mysqli_query($conn, "UPDATE users SET status = 'on' WHERE user_id = '$_SESSION[user_id]'");

}

 ?>

<?php 	$user_id = $_SESSION['user_id']; ?>

<div class="contain">
	<div class="home_page">
		<div class=" sect-1 p-0">
		<div class = "d-flex flex-column  align-items-center p-4 bg-dark ">
			<div class="user_img ">
				<?php
					$select = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $user_id");
					while($row = mysqli_fetch_array($select)){
						?>
							<img src="imgs/upload/<?php echo $row['user_img'] ?>">
						<?php
					}
				?>
			</div>
			<div class="mt-2 hide">
				<h5>
					<?php
						echo $_SESSION['name'];
					?>
					<a href="edit.php?u_id=<?php echo $user_id ?>" class="edit"><i class="las la-edit "></i></a>
				</h5>
			</div>
			<div id="logout" class="hide">
				<form method="POST">
					<input type="submit" name="logout" value="logout" class="btn btn-danger">
				</form>
			</div>

		</div>

			<form id="form_search" class=" input-group search">
				<input type="text" id="input_search" class="form-control hide" placeholder="Search User">
				<input type="hidden"  id="us_id" value="<?php echo $_SESSION['user_id']; ?>">
				<button type="submit" name="user_name" class="btn btn-primary buto hide"><i class="las la-search" ></i></button>
			</form>
		
		<div id="users">
			<?php
				$fetch = mysqli_query($conn,"SELECT * FROM users WHERE user_id != '$user_id' ORDER BY user_name ASC");


				if (!$fetch) {
					echo "ERROR: ".mysqli_error($fetch);
				}
				while($row = mysqli_fetch_array($fetch)){

					?>

									<a class="user" href="?rec_id=<?php echo $row['user_id'] ?>" >
										<div class=" u_img">
											
											<img src="imgs/upload/<?php echo $row['user_img'] ?>">
										</div>
										<div class="text hide">

												<?php
													echo $row['user_name'];
												?>

			
											<!--<span class="time">1 hour ago</span>-->

										</div>
										<div class="status" id="sts">
											<?php
											
												if ($row['status'] == "on") {
													?>
														<div class="on"></div>
													<?php
												}else{
													?>
														<div class="off"></div>
													<?php
												}
										
											?>
										</div>
									</a>



					<?php
				}

			 ?>
		</div>
		<!--           view all user search-->
		<div id="demo"></div>


		</div>
		<div class="sect_2 d-flex flex-column flex-grow-1">
			
				<?php include 'nav.php'; ?>
			

			<!--            view all posts             --> 

		

			

		<!--             chatting section             -->

			<div class="tabs">
				<?php if (isset($_GET['rec_id'])) {
					$rec_id = $_GET['rec_id'];
					$sel1 = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $rec_id");


					while($row = mysqli_fetch_array($sel1)){


					?>
					<a href="home.php" class="btn btn-secondary m-2"> <i class="las la-home"></i> home</a>
					<div class="all_msg" id="chatbox">

						<div id="data">

						</div>
					</div>

					<form id="msgForm" class="input-group msgfrm">

						<textarea id="msg" class="form-control"></textarea>
						<input type="submit" value="send" class="btn btn-primary">
					</form>
					<?php


					}
				}else{
					//code for post-side
					$date = date("Y-m-d");	
					// select distinct users in posts table
					$sel = mysqli_query($conn,"SELECT DISTINCT user_id FROM  posts WHERE curt_date = '$date'");


					if (mysqli_num_rows($sel) >= 1 ) {
						while ($row1 = mysqli_fetch_array($sel)) {
							//take users id
							$id = $row1['user_id'];
							//select all users by each one data
							$sel2 = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $id");
							
							
								
							while ($row3 = mysqli_fetch_array($sel2)) {
							//select users posts
							$sel3 = mysqli_query($conn,"SELECT * FROM posts WHERE user_id = $id AND curt_date = '$date'");
							if (!$sel3) {
								echo mysqli_error($conn);
							}
						
						?>
						
						<div class="container">
							<div class="u_posts container">	
								<div class="card">
									<div class="post_head ">
										<div class="card-header">
										<div class="name d-flex align-items-center ">
											
											<div class="u_img">
												<img src="imgs/upload/<?php echo $row3['user_img']?>" alt="" srcset="">
											</div>
											<div >
												<h5 class='text-white'>
													<?php
													
														echo $row3['user_name'];
													?>
												</h5>
											</div>
											
										</div>
									</div>
									
									</div>

									<div class="card-body post_m_b">
									<a href="edit.php?u_id=<?php echo $u_id ?>" >add new post</a>
									<?php
									
										$sel4 = mysqli_query($conn,"SELECT COUNT(user_id) FROM posts WHERE user_id = $id AND curt_date = '$date'");
										$fetch = mysqli_fetch_array($sel4);
										$count =  array_shift($fetch);

										if ($count > 1) {
											?>
												<i class="las la-angle-left la-2x prev"></i>
									   			 <i class="las la-angle-right la-2x next"></i>
											<?php
										}
										?>
										
									  
										<div class="post_body ">
											
												
													
											<div class="posts">
												<?php
													while ($row4 = mysqli_fetch_array($sel3)) {
													?>
														<img src="posts/imgs/<?php echo $row4['post_img']?>" alt="" srcset="">
													<?php
													}
												?>
													
											</div>
														
												
															
										</div>
										<?php
									
									?>	
									</div>
									<div class="card-footer">
									</div>
								</div>
							</div>
						</div>
						
					<?php

							}
						
					}
					}else{
						?>
							<div class="p-3">
								<p>No Post To Day</p>
								<a href="edit.php?u_id=<?php echo $u_id ?>" >add new post</a>
							</div>
							
						<?php
					}
				}

				?>


			</div>
		</div>
	</div>
</div>













	 <script type="text/javascript">
		//status offline and online
		/*
		setInterval(() => {
				xhr = new XMLHttpRequest();

				xhr.open("POST","online.php");

				xhr.onload = function(){
					if (this.status == 200) {
						document.getElementById("sts").innerHTML = this.response;
						console.log(this.response);
					}
				}
				xhr.send();


			}, 200);
			*/
		var chatbox = document.getElementById("chatbox");
				// jquery for post slides

				$(document).ready(function() {
					$('.posts').slick({
						slidesToshow: 1,
						fade: true,
						autoplay: true,
						autoplaySpeed: 3000,
						prevArrow : $(".prev"),
						nextArrow : $(".next")
					});
				});



				// scroll to bottom automaticaly

		function scrollToBottom(){
			chatbox.scrollTop = chatbox.scrollHeight;
		}
	 // code for displaying user chat section


	 
	 //script for searching the user
	 
	 document.getElementById("form_search").addEventListener("keyup",myFunct);
	 	function myFunct(e){
	 		e.preventDefault();


	 		//declare all needed variable
	 		var input = document.getElementById("input_search").value;


	 		//hide default block of users
	 		var users = document.getElementById("users");
	 		if (input != "") {
	 			users.style.display = "none";
			}else{
	 			users.style.display = "block";

			}
			console.log(input);

	 		var id = document.getElementById("us_id").value;
	 		var xhr = new XMLHttpRequest();

	 		var parms = "user_name=" + input + "&us_id=" + id;

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


	 //ajax for sending msg


	 var form1 = document.querySelector(".msgfrm");
	 var inputField = document.getElementById("msg");
	 form1.addEventListener("submit",sends);
	 function sends(e){
		 e.preventDefault();
		 xhr = new XMLHttpRequest();

		 var input = document.getElementById("msg").value;

		 var parm = "send="+input+"&sender="+<?php echo $_SESSION['user_id']; ?>+"&recv="+<?php if(isset($_GET['rec_id'])) echo $_GET['rec_id'] ?>



		 xhr.open("POST","sendmsg.php",true);
		 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


		 xhr.onload = function(){
			 if (this.status == 200) {
				 inputField.value = "";
				 scrollToBottom();
				 //document.getElementById("demo").innerHTML = this.responseText
			 }
		 }

		 xhr.send(parm);



	 }
	 

	 

		//code for displaying messages
		setInterval(getchat,300);
		
		function getchat(){
			
			xhr = new XMLHttpRequest();

			var names = "sender="+<?php echo $_SESSION['user_id']; ?>+"&recv="+<?php if(isset($_GET['rec_id'])) echo $_GET['rec_id'] ?>

			xhr.open("POST","getData.php",true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.onload = function(){
				if (this.status == 200) {
					document.getElementById("data").innerHTML = this.responseText;
					scrollToBottom(); 
				}
			}


			xhr.send(names);

		}

		
		
		
		

		
	 </script>

<?php include 'links.php' ?>
