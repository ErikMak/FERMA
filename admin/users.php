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
	<main>
	<div class="main-container section_column with_setting">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Поиск пользователей</h4>
		<p style="margin-bottom: 10px;">Поиск ID пользователей по базе данных проекта. Для начала работы введите ник или часть ника:</p>
		<form class="form-inline">
			<input class="form-control" type="text" placeholder="Username"  name="username" style="margin-right: 2%; width: 78%">
			<button id="find-user" type="submit" class="btn blue" style="width: 20%">Получить</button>
		</form>
	</div>
	</main>
	<main>
	<div class="main-container section_column">
		<table class="table table-sm table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col" >Пользователь</th>
		      <th scope="col" >Дата регистрации</th>
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
			let username = $('input[name="username"]').val();
			if (username != "") {
				$.ajax({
					url: '/request/find_id.php',
					type: 'POST',
					dataType: 'html',
					data: {
						username: username,
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