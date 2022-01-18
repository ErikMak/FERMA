<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Справочник");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper">
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">C чего начать?</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p>Для начала рекомендуем изучить всю информацию, представленную в этом разделе. Она вам поможет ознакомится с игровыми механики, принципами игры и ответит на часто задаваемые вопросы.</p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Игровая валюта</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p>На проекте существует два вида игровой валюты: баксы ($) и кристаллы (C).</p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Уровни и опыт</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p>Игроки получают опыт за покупку новых объектов собственности. Каждый</p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Временные циклы и сезоны</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p>На проекте реализована смена времен года. Каждый сезон года изменяется по дням и длится 2 недели.</p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Собственность и покупка собственности</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Ферма</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p>Ваша игровая ферма представляет собой Ваши фермерские постройки (раздел "Моя собственность"), складские помещения фермы (раздел "Товарный склад") и поля (раздел "Поле"). Узнать о состоянии фермы можно в меню фермы, которое находится в разделе "Моя собственность" или "Поле". </p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Улучшение фермы</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Культурные растения и покупка семян</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Поле</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Товарный склад</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Контракты</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
	<main>
	<details class="main-container section_column" style="padding: 20px">
		<summary><h5 style="margin: 0; font-size: 18px;">Выплаты</h5></summary>
		<div class="rules-section" style="margin-top: 15px;">
		<p></p>
		</div>
	</details>
	</main>
</div>
</div>
</div>
<?php include "inc/footer.php";
	?>
<? bottom();
?>