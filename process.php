<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "exam_data";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$user_id = $_POST["user_id"];
$name = $_POST["name"];
$subject = $_POST["subject"];
$time = $_POST["time"];
$ctrl = $_POST["ctrl"];
$comment = $_POST["comment"];

$message_name = "Уважаемый, $name!";
$message = "Ждём вас на экзамен по $subject в $time. Экзамен пройдет в форме $ctrl.";
if (!empty($comment)) {
	$message .= "\nСпасибо за комментарий: $comment";
}

$text = "$name записан на экзамен по $subject в $time.\nЭкзамен пройдет в форме $ctrl.";

$sql = "INSERT INTO records (user_id, text, comment) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $text, $comment);
$stmt->execute();
$stmt->close();

$conn->close();
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Задание 2</title>
  <link rel="stylesheet" href="style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
	<header>
	<div class="logo"><a href="example.html">
				<img src="images/logo.png" alt="Логотип" width="71" height="69">
			</a></div>
		<nav>
			<ul>
				<li><a href="index.html">
				О себе
				</a></li>
				<li><a href="info.html">
				Резюме
				</a></li>
				<li><a href="appointment.html">
				Запись на аттестацию
				</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="example"><div>
		<h1><?= $message_name ?></h1>
		<h2><?= $message ?></h2>
		</div></div>
		<form action="example.html" method="post" id="select-button">
			<input type="submit" id="button" value="Ок">
		</form>
	</main>
	<footer>
		<div class="icons">
		<a href="https://vk.com/">
			<img src="images/vk.svg" alt="vk" width="48" height="48">
		</a>
		<a href="https://www.deviantart.com">
			<img src="images/deviantart.svg" alt="deviantart" width="48" height="48">
		</a>
		<a href="https://www.youtube.com">
			<img src="images/youtube.svg" alt="youtube" width="48" height="48">
		</a>
		</div>
		<h3>Сайт разработан ФИ, Copyright © 2023</h3>
	</footer>
</body>
</html>