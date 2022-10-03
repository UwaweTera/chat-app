<?php 
	$con = mysqli_connect("localhost","root","","chatting");

	

	if ($_POST['user_name']) {
		
		
		$search = $_POST['user_name'];
		$user_id = $_POST['us_id'];
		$sel = mysqli_query($con,"SELECT * FROM users WHERE user_name LIKE '%$search%' AND user_id != '$user_id'");
		
		if (mysqli_num_rows($sel) >=1 ) {
		
		
			while ($row = mysqli_fetch_array($sel)) {
				
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
										<div class="status">
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
		}else{
			echo "no result";
		}
	}
	
	
 ?>