<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-UA-Compatible" content="ie-edge">
	<title>FERMA</title>
	<link rel="stylesheet" href="/files/bootstrap.css"> <!--Bootstrap-->
	<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<style type="text/css">
	body {
		background: #FFFCF2;
		position: relative;
	}
	.logo-bar {
		padding: 0.7rem 1.1rem;
		background: #fff;
	}
	.logo-bar img {
		width: 120px;
		height: auto;
		padding-top: 0.3125rem;
    	padding-bottom: 0.3125rem;
	}
	hr {
		margin: 0;
	}
	.container {
		min-height: 70vh;
	}
	h1 {
		font-size: 8rem;
		font-family: 'Cairo', sans-serif;
		margin: 0;
	}
	p {
		font-family: 'Open Sans', sans-serif;
		font-weight: 600;
		margin-top: -15px;
		margin-bottom: 3rem;
	}
	button {
		border-radius: 30px !important;
		background: linear-gradient(to right, #F8D654, #FCB55A);
		border-style:  none  !important;
		padding: 0.5rem 4rem !important;
		font-family: 'NoirPro', sans-serif;
		box-shadow: 0 5px 5px 0 rgba(0,0,0,0.2);
	}
	button:hover {
		background: linear-gradient(to right, #F0CE4A, #EDA952);
	}
	.svg {
		position: absolute;
		top:  32vh;
		left:  17vw;
		width:  12rem;
		height: auto;
	}
</style>
<body>
	<div class="logo-bar">
		<img src="/img/LogoYellow.svg">
	</div>
	<hr>
	<div class="outer">
		<div class="container d-flex align-items-center justify-content-center flex-column">
		  	<h1><b>404</b></h1>
		  	<p style="margin-bottom: 0;">Упс... Что-то пошло не так</p>
		  	<button onclick="location.href = 'home';" type="button" class="btn btn-info">Домой</button>
		</div>
		<img class="svg" src="/img/404.svg">
	</div>
</body>
</html>