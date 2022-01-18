<script type="text/javascript">
// SHOW/HIDE SIDEBAR
$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
 	});
});
// DISABLE LINKS
$(function() {
	$('#main-menu li a').each(function() {
		if(document.location.pathname == '/' + $(this).attr('href')) {
			$(this).addClass('disabled');
		}
	});
});
</script>
<nav id="main-menu" class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand"><img src="img/LogoDark.svg"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
		    	<a class="nav-link" href="news"><i class="fas fa-home-lg-alt"></i>Новости</a>
			</li>
			<!-- <li class="nav-item">
		    	<a class="nav-link" href="#"><img src="icons/wallet.png">Выплаты</a>
			</li> -->
			<li class="nav-item">
		    	<a class="nav-link" href="bonus"><i class="fas fa-gift"></i>Бонусы</a>
			</li>
			<li class="nav-item">
		    	<a class="nav-link" href="support"><i class="far fa-user-headset"></i>Помощь</a>
			</li>
		</ul>
	<form class="form-inline my-2 my-lg-0" style="margin-right: 10px;">
		<button type="button" id="sidebarCollapse" class="btn yellow-outline" ><span>Меню</span></button>
	</form>
	<form class="form-inline my-2 my-lg-0">
		<button style="" onclick="document.location='profile'" type="button" class="btn yellow"><span>Профиль</span></button>
	</form>
	</div>
</nav>