<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Мои рефералы");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper">
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Реферальная система</h4>
		<p>Здесь находится статистика всех ваших рефералов. Приглашайте новых пользователей по специальной реферальной ссылке или баннеру, чтобы получать дополнительные бонусы для своего аккаунта.</p>
	</div>
	</main>
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Бонусы</h4>
		<div class=""></div>
	</div>
	</main>
	<main>
	<div class="main-container section_column">
		<p style="margin-bottom: 10px">Основная реферальная ссылка:</p>
		<form class="form-inline" style="margin-bottom: 40px">
			<? echo '
		   	<input class="form-control" type="text" value="index.php?page='.$_SESSION['user_data']['id'].'" readonly id="copy" style="margin-right: 18px; width: 40%">'
		   	?>
		    <button type="button" class="btn yellow" id="copy_button"><span>Скопировать</span></button>
		</form>
		<p style="margin-bottom: 10px">Список рефералов</p>
		<table class="table">
		  <thead class="thead-dark">
		    <tr style="border-radius: 7px;">
		      <th scope="col" style="background: black">#</th>
		      <th scope="col" style="background: black">Дата регистрации</th>
		      <th scope="col" style="background: black">Пользователь</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?  $number = 1;
				$result = $connection->select("users", ["user", "timestamp"], ["ref" => $_SESSION['user_data']['id'], "ORDER" => [ "id" => "DESC"]]);
				foreach($result as $ref) {
					echo '<tr>
		    		  <th scope="row">'.$number++.'</th>
				      <td>'.$ref["timestamp"].'</td>
				      <td>'.$ref["user"].'</td>
				    </tr>';
				}
		    ?>
		  </tbody>
		</table>
	</div>
	</main>
</div>
</div>
</div>
<script type="text/javascript">
	$('#copy_button').click(function(e){
		e.preventDefault();
		let copyText = document.getElementById("copy");
		copyText.select();
		document.execCommand("copy");
	});
</script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>