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
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Выдать блокировку аккаунту</h4>
		<p style="margin-bottom: 10px;">Чтобы выдать бан игроку, введите его зарегистрированный идентификатор и причину бана:</p>
		<form class="form-inline" style="margin-bottom: 10px;">
			<label for="exampleFormControlTextarea1"  style="margin-bottom: 10px;">Причина блокировки:</label>
		    <textarea class="form-control" id="reason" style="font-family: 'Open Sans', sans-serif; width: 100%; margin-bottom: 20px;"></textarea>
			<input class="form-control" type="text" placeholder="User ID"  name="user_id" style="margin-right: 2%; width: 78%">
			<div class="form-group">
		    </div>
			<button id="find-user" type="submit" class="btn blue" style="width: 20%">Подтвердить</button>
		</form>
	</div>
	</main>
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 20px;">Пользователи с блокировкой</h4>
		<table class="table table-sm table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">IP</th>
		      <th scope="col">Ник</th>
		      <th scope="col">Заблокирован</th>
		      <th scope="col">По причине</th>
		      <th scope="col">Снять</th>
		    </tr>
		  </thead>
		  <tbody>
		  <style>
		  	.delete {
				text-decoration: underline;
				color: #D62B2B;
				font-family: @OpenSans;
			}
			.delete:hover {
				color: #BA2F2F;
			}
		  </style>	
		  	<?	require_once 'request/db.php';
				$result = $connection->select("ban_list", "*");
				foreach($result as $users) {
					echo '<tr>
			      		<td>'.$users["ip_address"].'</td>
			      		<td>'.$users["user"].'</td>
			      		<td>'.$users["timestamp"].'</td>
			      		<td>'.$users["reason"].'</td>
			      		<td><a href="#" id="'.encrypt($users["user_id"]).'" class="delete">Удалить</a></td>
			    	</tr>';
				}
		    ?>
		  </tbody>
		</table>
	</div>
	</main>
	<div class="popup-fade question set_ban">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
			<div class="slider">
			<input type="password" name="secret_code" class="form-control form-control-lg" style="width: 100%;">
			</div>
			<button type="button" id="set_ban" class="btn blue-outline btn-block">Подтвердить</button>
		</div>
	</div>
	<div class="popup-fade question unset_ban">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
			<div class="slider">
			<input type="password" name="secret_code" class="form-control form-control-lg" style="width: 100%;">
			</div>
			<button type="button" id="unset_ban" class="btn btn-outline-primary btn-block">Подтвердить</button>
		</div>
	</div>
	<div class="popup-fade confirm">
	<div class="popup">
		<a href="#" title="Закрыть" class="popup-close">✕</a>
		<h5 style="margin: 0 0">Title</h5>
		<svg class="checkmark green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle green" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
	</div>
	</div>
	<div class="popup-fade error">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin: 0 0">Title</h5>
			<svg class="checkmark red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle red" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/></svg>
		</div>
	</div>
</div>
</div>
</div>
<script>
	$(document).ready(function () {
		let user_id;
		let secret_code;
		let reason;
		$('#find-user').click(function(e){
			e.preventDefault();
			user_id = $('input[name="user_id"]').val();
			reason = $('#reason').val();
			if ((user_id != "") && (reason != "")) {
				showPopup('.set_ban', 'Ввод ключа', 'Введите ключ-код разработчика для доступа к этой функции');
				return user_id;
			}
		});
		$('#set_ban').click(function(e){ 
			e.preventDefault();			
			secret_code = $('.set_ban input[name="secret_code"]').val();

			$('.question').fadeOut();
			$.ajax({
					url: '/request/set_ban.php',
					type: 'POST',
					dataType: 'json',
					data: {
						user_id: user_id,
						secret_code: secret_code,
						reason: reason,
					},
					success: function(data) {
							if (data['status'] === true) {
								showPopup('.confirm', data['title']);
							} else {
								showPopup('.error', data['title']);
							}
					}
			});
		});



		$('td a').click(function(e){
			e.preventDefault();
			user_id = $(this).attr("id");
			showPopup('.unset_ban', 'Ввод ключа', 'Введите ключ-код разработчика для доступа к этой функции');
			return user_id;
		});
		$('#unset_ban').click(function(e){ 
			e.preventDefault();			
			secret_code = $('.unset_ban input[name="secret_code"]').val();

			$('.question').fadeOut();
			$.ajax({
					url: '/request/unset_ban.php',
					type: 'POST',
					dataType: 'json',
					data: {
						user_id: user_id,
						secret_code: secret_code,
					},
					success: function(data) {
							if (data['status'] === true) {
								showPopup('.confirm', data['title']);
							} else {
								showPopup('.error', data['title']);
							}
					}
			});
		});
	});
</script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>