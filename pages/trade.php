<?php
	if(!$_SESSION['user_data']) {
		header('Location: home');
	}
	top("Торговая площадка");
?>
<div id="main">
	<?php include "inc/header.php";
	?>
<div class="wrapper">
	<?php include "inc/sidebar.php";
	?>
<div class="content-wrapper">
	<div class="marketplace-section">
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Торговая площадка</h4>
		<p style="margin-bottom: 10px;">Разместить товар на торговой площадке</p>
		<form>
			<div class="col" style="padding: 0; margin-bottom: 10px;">
		    <select class="form-control" id="product" style="font-family: 'Open Sans', sans-serif;">
		      <option value="salad">Салат</option>
		      <option value="cucumber">Огурец</option>
		      <option value="potato">Картофель</option>
		      <option value="turnip">Репа</option>
		      <option value="squash">Кабачок</option>
		      <option value="cauliflower">Цветная капуста</option>
		      <option value="corn">Кукуруза</option>
		      <option value="tomato">Помидор</option>
		      <option value="radish">Редис</option>
		      <option value="pepper">Перец</option>
		      <option value="eggplant">Баклажан</option>
		      <option value="beet">Свекла</option>
		      <option value="pumpkin">Тыква</option>
		      <option value="chin_cabbage">Китайская капуста</option>
		      <option value="artichoke">Артишок</option>
		      <option value="material">Материалы</option>
		      <option value="fuel">Топливо</option>
		    </select>
		    <small class="form-text text-muted">
			  Укажите что хотите продать
			</small>
		  </div>
		  <div style="margin-bottom:10px;">
		    <input class="form-control" type="text" placeholder="Количество" id="quantity">
		  </div>
		  <div class="row" style="margin-bottom:15px;">
		  	<div class="col">
		    	<label for="exampleFormControlTextarea1">Цена за ед. товара</label>
		    	<input class="form-control" type="text" placeholder="Цена за ед." id="unitPrice">
			</div>
			<div class="col">
		    	<label for="exampleFormControlTextarea1">Конечная цена лота</label>
		    	<fieldset disabled><input class="form-control" type="text" placeholder="" id="lotPrice"></fieldset>
		    	<small class="form-text text-muted">
			  С учетом НДС 8%
			</small>
			</div>
		  </div>
		  <button type="submit" class="btn green-outline btn-block" id="place">Разместить</button>
		</form>
	</div>
	</main>
		<div class="marketplace-column">
		<div class="container">
		  <div class="row">
		    <div class="col-sm" style="padding-left: 0">
		      <main style="background: #1a1a1a; color: white;">
		      	<div class="d-flex flex-column p-3 mb-2">
		      		<p style="color: #9E9E9E;font-size: 13px;font-family: 'Open Sans';"><b>Лотов</b></p>
		      		<h4><b class="lots_quan"><?
		      		echo $connection->count("marketplace", [
						"user_id" => $_SESSION["user_data"]["id"]
					]);
		      		?></b> <p style="font-size: 13px; position: relative;">позиция</p></h4>

		      	</div>
				<svg xmlns="http://www.w3.org/2000/svg" style="border-radius: 5px;" viewBox="0 0 1440 320">
				  <path fill="#f82956" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,117.3C384,85,480,43,576,37.3C672,32,768,64,864,112C960,160,1056,224,1152,218.7C1248,213,1344,139,1392,101.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
				    <path fill="#f82956" fill-opacity="0.4" d="M0,32L48,74.7C96,117,192,203,288,234.7C384,267,480,245,576,197.3C672,149,768,75,864,37.3C960,0,1056,0,1152,10.7C1248,21,1344,43,1392,53.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
				</svg>
		      </main>
		    </div>
		    <div class="col-sm" style="padding-right: 0">
		      <main style="background: #1a1a1a; color: white;">
		      	<div class="d-flex flex-column p-3 mb-2">
		      		<p style="color: #9E9E9E;font-size: 13px;font-family: 'Open Sans';"><b>На сумму</b></p>
		      		<h4><b class="summa"><?
		      		$result = $connection->select("marketplace", ["lotPrice"], ["user_id" => $_SESSION['user_data']['id']]);
		      		$sum = 0;
		      		foreach ($result as $lot) {
		      			$sum+=$lot["lotPrice"];
		      		}
		      		echo round($sum - $sum*0.08);
		      		?></b>$<p style="font-size: 13px; position: relative;">с вычетом НДС 8%</p></h4>
		      	</div>
				<svg xmlns="http://www.w3.org/2000/svg" style="border-radius: 5px;" viewBox="0 0 1440 320">
				  <path fill="#2db59a" fill-opacity="0.4" d="M0,192L48,181.3C96,171,192,149,288,117.3C384,85,480,43,576,37.3C672,32,768,64,864,112C960,160,1056,224,1152,218.7C1248,213,1344,139,1392,101.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
				    <path fill="#2db59a" fill-opacity="1" d="M0,32L48,74.7C96,117,192,203,288,234.7C384,267,480,245,576,197.3C672,149,768,75,864,37.3C960,0,1056,0,1152,10.7C1248,21,1344,43,1392,53.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
				</svg>
		      </main>
		    </div>
		  </div>
		</div>
		</div>
	</div>
	<main>
	<div class="main-container section_column">
		<h4 style="font-size: 22px; margin-bottom: 10px;">Мои лоты</h4>
		<table class="table table-hover table-sm" style="font-size: 14px;margin-bottom: 0" id="lots">
		  <thead style="background-color: #5161ce; color: white">
		    <tr>
		      <th scope="col">№ Лота</th>
		      <th scope="col">Товар</th>
		      <th scope="col" style="text-align: center;">Количество</th>
		      <th scope="col" style="text-align: center;">Стоимость</th>
		      <th scope="col" style="text-align: center;">Снять лот</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?
		  	$result = $connection->select("marketplace", ["id", "productNameRU", "quantity", "lotPrice"], ["user_id" => $_SESSION['user_data']['id']]);
		  	foreach ($result as $lot) {
		  	echo '<tr>
		      <td style="line-height: 30px;"><b>'.$lot["id"].'</b></td>
		      <td style="line-height: 30px;">'.$lot["productNameRU"].'</td>
		      <td style="line-height: 30px; text-align: center;">'.$lot["quantity"].' шт.</td>
		      <td style="line-height: 30px; text-align: center; color: #659b25"><b>'.$lot["lotPrice"].' $</b></td>
		      <td style="line-height: 30px; text-align: center;"><a href="#" class="delete">Удалить</a></td></tr>';
		  }?>
		  </tbody>
		</table>
	</div>
	</main>
	<div class="container">
		<div class="row">
			<div class="col-3 p-0">
				<div id="accordian" class="mb-5">
					<h6>Категории</h6>
					 <ul class="show-dropdown main-navbar">
					 <div class="selector-active"><div class="top"></div><div class="bottom"></div></div>
					 <li class="active">
					 <a name="spring" href="javascript:void(0);"><i class="fas fa-angle-right"></i> Весенние продукты</a>
					 </li>
					 <li>
					 <a name="summer" href="javascript:void(0);"><i class="fas fa-angle-right"></i> Летние продукты</a>
					 </li>
					 <li>
					 <a name="autumn" href="javascript:void(0);"><i class="fas fa-angle-right"></i> Осенние продукты</a>
					 </li>
					 <li>
					 <a name="material" href="javascript:void(0);"><i class="fas fa-angle-right"></i> Стройматериалы</a>
					 </li>
					 </ul>
				</div>
			</div>
			<div class="col">
				<main>
				<div class="main-container section_column">
				<div class="d-flex justify-content-between align-items-center">
					<h4 style="font-size: 22px; margin-bottom: 10px;">Торговля</h4>
					<p>
		  	<label class="switch" style="margin-bottom: 0.2rem">
		    <input id="list-setting" type="checkbox"> <!-- checked - on значение у чекбокса /!-->
		    <span class="slider"></span>
		  	</label> Отсортировать по цене
			</p>
					</div>
				<table class="table table-hover table-sm" style="margin-bottom: 0;font-size: 14px;">
				  <thead style="background-color: black; color: white">
				    <tr>
				      <th scope="col">№ Лота</th>
				      <th scope="col">Товар</th>
				      <th scope="col" style="text-align: center;">Количество</th>
				      <th scope="col" style="text-align: center;">Стоимость</th>
				      <th scope="col">Приобрести</th>
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
</div>
</div>
</div>
<script src="/scripts/marketplace.js"></script>
<script type="text/javascript">
// Connect WEBSOCKET
let ws = new WebSocket("ws://127.0.0.1:8000/?user="+<? echo $_SESSION['user_data']['id'];?>);
ws.addEventListener('message', (e) => {
	if (e.data == true) {
		// Load lots by websocket request
		let category = $("#accordian .active").children().attr("name");
		let checkbox = document.getElementById("list-setting").checked;
		$.ajax({
			url: '/request/load_lots.php',
			type: 'POST',
			dataType: 'html',
			data: {
				checkbox: checkbox,
				category: category,
			},
			success: function(data) {
				$("#responsecontainer").html(data);
			}
		});
		var today = new Date();
		ws.send('['+today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds()+'] == Торговая площадка == '+<?echo $_SESSION['user_data']['id']?>+' ID подгрузил лоты');
	}
});
</script>
<?php include "inc/footer.php";
	?>
<? bottom();
?>