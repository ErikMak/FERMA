<?php
	top("Админ-панель");
?>
<div id="main">
	<?php include "inc/admin_header.php";
	?>
<div class="wrapper">
	<?php include "inc/admin_sidebar.php";
	?>
<div class="content-wrapper">
	<main >
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Записи событий</h4>
		<p style="margin-bottom: 10px;">Мониторинг действий пользователей. Для начала работы введите идентификатор игрока:</p>
		<form class="form-inline" style="margin-bottom: 10px;">
			<input class="form-control" type="text" placeholder="User ID"  name="user_id" style="margin-right: 2%; width: 78%">
			<button id="find-user" type="submit" class="btn blue" style="width: 20%">Получить</button>
		</form>
		<p>
		  <label class="switch" style="margin-bottom: 2px;">
		    <input id="list-setting" type="checkbox" name="country"> <!-- checked - on значение у чекбокса /!-->
		    <span class="slider"></span>
		  </label> Показывать только первые 100 лотов
		</p>
	</div>
	</main>
	<main>
	<div class="main-container section_column">
		<table class="table table-sm table-bordered" style="font-size:14px">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Временная метка</th>
		      <th scope="col" >Действие</th>
		    </tr>
		  </thead>
		  <tbody id="responsecontainer">
		  </tbody>
		</table>
	</div>
	</main>
</div>
</div>
</div>
<script>
	$(document).ready(function () {
	$('#find-user').click(function(e){
			e.preventDefault();
			let user_id = $('input[name="user_id"]').val();
			let checkbox = document.getElementById("list-setting").checked;
			if (user_id != "") {
				$.ajax({
					url: '/request/show_logs.php',
					type: 'POST',
					dataType: 'html',
					data: {
						user_id: user_id,
						checkbox: checkbox,
					},
					success: function(data) {
							$("#responsecontainer").html(data);
					}
				});
			}
		});
	});
</script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>