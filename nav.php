<?php
	$u_id =	$_SESSION['user_id'];
	if (isset($_POST['logout'])) {
		$up = mysqli_query($conn, "UPDATE users SET status = 'off' WHERE user_id = '$_SESSION[user_id]'");
		session_destroy();
		session_unset();
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>chat</title>

	<style type="text/css">
		nav{
			float: right;
		}
	</style>
</head>
<body>

	<nav class="nav d-flex flex-wrap ">
	<div class="name d-flex align-items-center ">
		
		<div class="u_img">
			<?php
				if(isset($_GET['rec_id'])) {
					$rec_id = $_GET['rec_id'];
					$sel1 = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $rec_id");
					while($row = mysqli_fetch_array($sel1)){
						?>
							<img src="imgs/upload/<?php echo $row['user_img'] ?>">
						<?php
						
					
				
			?>
		</div>
		<div >
			<h5>
				<?php
					echo $row['user_name'];
				}
			}
				?>
			</h5>
		</div>
		
	</div>
			
	

	</nav>

	<?php include 'links.php' ?>
</body>
</html>
