<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Добыча леса");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper" style="margin-bottom: 50px;">
	<ul class="nav nav-pills" id="pills-tab" role="tablist" style="margin-bottom: 30px">
	  <li class="nav-item" role="presentation">
	    <button class="active" style="margin-right: 13px;" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Предприятия</button>
	  </li>
	  <li class="nav-item" role="presentation">
	    <button style="margin-right: 13px;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Покупка</button>
	  </li>
	  <li class="nav-item" role="presentation">
	    <button id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Улучшения</button>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  <!-- Первая страница -->
	  </div>
	  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
	  	<!-- Вторая страница -->
	  </div>
	  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
	  	<!-- Третья страница -->
	  </div>
	</div>
	<div class="popup-fade info">
	<div class="popup">
		<a href="#" title="Закрыть" class="popup-close">✕</a>
		<h5 style="margin-bottom: 20px;">Title</h5>
		<p style="margin-bottom: 20px;">Text</p>
	</div>
	</div>
	<div class="popup-fade question">
		<div class="popup">
			<a href="#" title="Закрыть" class="popup-close">✕</a>
			<h5 style="margin-bottom: 20px;">Title</h5>
			<p style="margin-bottom: 20px;">Text</p>
			<button type="button" id="question" class="btn btn-outline-primary btn-block">Да</button>
		</div>
	</div>
	<div id="tooltip"></div>
</div>
</div>
</div>
<script src="/scripts/mining.js"></script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>