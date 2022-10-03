<?php 
	include 'conn.php';

	if (isset($_POST['sender'])) {
		
	
		$sender_id = $_POST['sender'];
		$recv_id = $_POST['recv'];
		$msgs = mysqli_query($conn,"SELECT * FROM messages WHERE(FromUser = '$sender_id' AND ToUser = '$recv_id') OR (FromUser = '$recv_id' AND ToUser = '$sender_id')")or die("error to select".mysqli_error($conn	));


		while($chats = mysqli_fetch_array($msgs)){

			if ($chats['FromUser'] == $sender_id) {
				?>
					<div class="send">
						<p><?php echo $chats['message'] ?></p>
					</div>
				<?php
			}else{
				?>
					<div class="recev">
						<p><?php echo $chats['message'] ?></p>
					</div>
				<?php
			}
		}
	}



	
 ?>