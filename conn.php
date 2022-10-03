<?php session_start(); ?>

<?php

	$conn = mysqli_connect("localhost","root","","chatting");


	// create Chatting database
	$db = mysqli_query($conn,"CREATE DATABASE chatting");

	// create users table

	$user = mysqli_query($conn,"CREATE TABLE users(
		user_id int PRIMARY KEY AUTO_INCREMENT,
		user_name varchar(50),
		user_img varchar(100),
		user_age int,
		gender varchar(50),
		password varchar(50),
		status varchar(50)
	)");

	//create message table

	$table = mysqli_query($conn, "CREATE TABLE messages(
		msg_id int PRIMARY KEY AUTO_INCREMENT,
		FromUser int,
		FOREIGN KEY(FromUser) REFERENCES users(user_id),
		message text,
		ToUser int,
		FOREIGN KEY(ToUser) REFERENCES users(user_id),
	)");
	// create post table

	$posts = mysqli_query($conn, "CREATE TABLE posts(
		post_id int PRIMARY KEY AUTO_INCREMENT,
		post_img varchar(100),
		post_vid varchar(100),
		curt_date date,
		user_id int,
		FOREIGN KEY(user_id) REFERENCES users(user_id)
	)");




 ?>


