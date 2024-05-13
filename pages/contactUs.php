<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <style>
        *{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	font-family: 'Quicksand', sans-serif;
	border-radius: 20px;
}
a {
	color: white;
	text-decoration: none;
}

body{
	height: 100vh;
	width: 100%;
}

.form{
	position: relative;
	width: 100%;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 20px 100px;
}

.form:after{
	content: '';
	position: absolute;
	width: 100%;
	height: 100%;
	left: 0;
	top: 0;
	background: url("img/Just-do-it-background.jpeg") no-repeat center;
	background-size: cover;
	filter: blur(50px);
	z-index: -1;
}
.contact{
	max-width: 850px;
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	justify-content: center;
	align-items: center;
	text-align: center;
	background-color: #fff;
	box-shadow: 0px 0px 19px 5px rgba(0,0,0,0.19);
}
.right{
	padding: 25px 40px;
}

h2{
	position: relative;
	padding: 0 0 10px;
	margin-bottom: 10px;
}

h2:after{
	content: '';
    position: absolute;
    left: 50%;
    bottom: 0;
    transform: translateX(-50%);
    height: 4px;
    width: 50px;
    border-radius: 2px;
    background-color: orange;
}

.text{
	width: 100%;
	border: 2px solid rgba(0, 0, 0, 0);
	outline: none;
	background-color: rgba(230, 230, 230, 0.6);
	padding: 0.5rem 1rem;
	font-size: 1.1rem;
	margin-bottom: 22px;
	transition: 0.10s;
}

.text:hover{
	background-color: rgba(0, 0, 0, 0.1);
}

textarea{
	min-height: 150px;
}

.btn{
	width: 100%;
	padding: 0.5rem 1rem;
	background-color: orange;
	color: #fff;
	font-size: 1.1rem;
	border: none;
	outline: none;
	cursor: pointer;
	transition: .3s;
}
.text:focus{
    border: 2px solid rgba(30,85,250,0.47);
    background-color: #fff;
}

    </style>
</head>
<body>
	<div class="form bg-primary">
		<div class="contact">
			<div class="right">
				<h2>Contact us</h2>
				<form action="connect.php" method="post">
					<input type="text" class="text" placeholder="Your Name" name="name">
					<input type="text" class="text" placeholder="Your Email" name="email">
					<input type="text" class="text" placeholder="Phone" name="phone">
					<textarea placeholder="Message" class="text" name="text"></textarea>
					<button class="btn" value="submit"><a href="../index.html">Send</a></button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>