<?php include 'conn.php'; 

    if (!isset($_SESSION['name'])) {
        header("location:index.php");
    }else{
        $u_id = $_SESSION['user_id'];
        $_SESSION['name'];
    }


?>


    <?php include 'nav.php'; ?>
    
    <a href="home.php"   class="btn btn-secondary m-3">back</a>
    

    <?php
        $msg = "";
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            
            
            
            $img = $_FILES['pic']['name'];
            if(empty($_FILES['pic']['name'])){
                $img = "Capture.png";
            }else{
                $img = $_FILES['pic']['name'];
            }
            $target = "imgs/upload/".basename($_FILES['pic']['name']);

            $upd = mysqli_query($conn,"UPDATE users SET user_name = '$name',user_img = '$img',user_age = '$age',gender = '$gender' WHERE user_id = $u_id");
            move_uploaded_file($_FILES['pic']['tmp_name'], $target);
            if($upd){
                $msg =  "updated";
            }else{
                $msg =  "error ".mysqli_error($conn);
            }
        }
    ?>
    <div class="container">
        <div class="row edit">
            <div class="col log hide">
                <img src="imgs/brand.jpg" class="img-fluid" alt="" srcset="">
            </div>
            <div class="col sign_in_form frm-color mt-3">
            <div class="mesages">
                    <h4 class="text-primary"><?php echo $msg ?></h4>
            </div>
            <?php 
                
                
                //check wheather user id setted
                if(isset($u_id)){

                    $sel = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $u_id");
                    while($row = mysqli_fetch_array($sel)){
                        $gender = $row['gender'];

                        
                        ?>

                        

                    <div class="img">
                    <img src="imgs/upload/<?php echo $row['user_img'] ?>">
                    </div>
                    <h3 class="text-center">Edit Your Profile</h3>
                    
                    <form action="" method="POST" class="form p-4" enctype="multipart/form-data">
                        <label><h4>Update Picture</h4></label> <br> 
                        <input type="file" name="pic"><br><br>
                        <label><h4>UserName</h4></label> <br> 
                        <input type="text" name="name" value="<?php echo $row['user_name'] ?>"><br>
                        
                        <label><h4>Age</h4></label> <br> 
                        <input type="number" name="age" value="<?php echo $row['user_age'] ?>"><br><br>
                        

                        <label><h4>Gender</h4></label> <br> 
                        <input class="form-check-input" type="radio" name="gender" value="Male" <?php if (isset($gender) && $gender == "Male") echo "checked" ?>> Male
                        <input class="form-check-input" type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender == "Female") echo "checked" ?>> Female <br>

                        <input type="submit" name="submit" value="Update" class="mt-4 mb-4" id="edit_btn">
                    </form>
                    <?php
                        }
                    }else{
                        header("location:home.php");
                    }   
                ?>
            </div>
    </div> 
    





    <div class="post mt-5 bg-dark  p-5" >   
        <?php
            $msg = "";
            if (isset($_POST['post_but'])) {
                $img = $_FILES['post_img']['name'];
                $vid = $_FILES['post_vid']['name'];
                $d  = date("Y-m-d");
                $user_id = $u_id;


                 // target place to store posts
                $target_img = "posts/imgs/". basename($_FILES['post_img']['name']);
                $target_vid = "posts/videos/".basename($_FILES['post_vid']['name']);

                //transfer posted to its destination

                if (move_uploaded_file($_FILES['post_img']['tmp_name'], $target_img)) {
                   
                    $ins = mysqli_query($conn,"INSERT INTO posts(post_img,post_vid,curt_date,user_id) VALUES('$img','$vid','$d','$user_id')");

                    if($ins){
                        $msg = "Posted";
                    }else{
                        $msg = "empty";
                    }
                }


            }
        
        ?>
        <h2 class="text-white  text-center">add post</h2>

        <form action="" method = "POST" class="form bg-light m-5 p-4" enctype="multipart/form-data">

            <div class="row">
                    <div class="col">
                        <label for="file"><h3>Add Post Picture</h3></label>
                        <input type="file" name="post_img" class="form-control">
                    </div>
                    <div class="col">
                        <label for="file"><h3>Add Post Video</h3></label>
                        <input type="file" name="post_vid" class="form-control">
                    </div>
            </div>
            
            <center> <input type="submit" name="post_but" value="Add Post" class="btn btn-primary m-4"><br></center>
           
            <div class = "">
                <h3 class="text-center text-primary">
                    <?php echo $msg ?>
                </h3>
                
            </div>
        </form>
    </div>





    </div>
    

    <script>
      
    </script>
<?php include 'links.php'; ?>