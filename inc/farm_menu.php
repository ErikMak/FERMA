<div class="farm-menu-wrapper">
<nav id="farm-menu">
    <ul class="list-unstyled components">
    <p>Компания</p>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Название:</b><b>name</b>
        </li>
    	<li>
        	<b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Уровень:</b><b><?= $_SESSION['farm_data']['level']?> (<?= $_SESSION['farm_data']['exp']?>/<?= $_SESSION['farm_data']['max_exp']?>)</b>
    	</li>
    </ul>
    <ul class="list-unstyled components">
		<p>Ферма</p>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Места доступно:</b><b class="size"><?= $_SESSION['farm_data']['size']?> яч.</b>
        </li>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Места занято:</b><b class="engaged"><?  require_once 'request/db.php';
                $count = $connection->count("user_feg", "*", ["user_id" => $_SESSION['user_data']['id']]);
                echo $count;
            ?> яч.</b>
        </li>
    </ul>
    <ul class="list-unstyled components">
        <p>Склад</p>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Продуктов:</b><b><? 
            use Medoo\Medoo;
            $result = $connection->select("storage", ["field_sum" => Medoo::raw("salad + cucumber + potato + turnip + squash + cauliflower + corn + tomato + radish + pepper + eggplant + beet + pumpkin + chin_cabbage + artichoke")],  ["user_id" => $_SESSION['user_data']['id']]);
            foreach($result as $farm) { echo $farm["field_sum"]; }
                ?> 
            шт.</b>
        </li>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Топливо:</b><b><?
            $count = $connection->sum("storage", "fuel", ["user_id" => $_SESSION['user_data']['id']]);
                echo $count;?> л.</b>
        </li>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Требуется:</b><b><?
            $count = $connection->sum("user_objects", "fuel", ["user_id" => $_SESSION['user_data']['id']]);
                echo $count;?> л. в дн</b>
        </li>
        <li>
            <b class="material" style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Материалов:</b><b><?
                $count = $connection->sum("storage", "material", ["user_id" => $_SESSION['user_data']['id']]);
                echo $count;
            ?> шт.</b>
        </li>
    </ul>
    <ul class="list-unstyled components" style="margin-bottom: 0;">
        <p>Улучшение</p>
        <li>
            <b style="font-family: 'Open Sans', sans-serif;font-weight: 500;">Вместимость:</b><b><?$result = $connection->select("storage", ["level"], ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $farm) { echo $farm['level']; }
            ?> (<?
                $result = $connection->select("storage", ["field_sum" => Medoo::raw("salad + cucumber + potato + turnip + squash + cauliflower + corn + tomato + radish + pepper + eggplant + beet + pumpkin + chin_cabbage + artichoke + fuel + material")],  ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $farm) { echo $farm["field_sum"]; }
                ?>/<?
                $result = $connection->select("storage", ["capacity"], ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $farm) { echo $farm['capacity']; }?>)</b>
        </li>
        <li>
            <button type="button" id="update" class="btn blue-outline btn-sm btn-block">Улучшить</button>
        </li>
    </ul>
</nav>
<main style="background: #e74c3c; color: white;" class="danger-board">
    <div class="main-container info-board" style="padding: 20px;">
    <svg style="margin-right: 20px; float: left;" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" class="bi bi-exclamation-square-fill" viewBox="0 0 16 16">
      <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg>
    <p style="font-size: 14px;">Внимание! Поставка урожая прекращена, из-за нехватки топлива для снабжения объектов</p>
</div>
</main>
<main style="background: #F2B828; color: white;" class="warning-board">
    <div class="main-container info-board" style="padding: 20px;">
    <svg style="margin-right: 20px; float: left;" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg>
    <p style="font-size: 14px;">Внимание! Поставка урожая скоро будет прекращена, из-за нехватки топлива для снабжения объектов</p>
</div>
</main>
</div>
<div class="popup-fade question_update">
    <div class="popup">
        <a href="#" title="Закрыть" class="popup-close">✕</a>
        <h5 style="margin-bottom: 20px;">Title</h5>
        <p style="margin-bottom: 20px;">Text</p>
        <button type="button" style="font-weight: 500;" id="question_update" class="btn blue-outline btn-block">Подтвердить</button>
    </div>
</div>
<div class="popup-fade confirm_update">
    <div class="popup">
        <a href="#" title="Закрыть" class="popup-close">✕</a>
        <h5 style="margin: 0 0">Title</h5>
        <svg class="checkmark green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle green" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
    </div>
</div>
<div class="popup-fade error_update">
    <div class="popup">
        <a href="#" title="Закрыть" class="popup-close">✕</a>
        <h5 style="margin: 0 0">Title</h5>
        <svg class="checkmark red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle red" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/></svg>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        let fuel = <? $result = $connection->select("storage", ["fuel"], ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $fuel) { echo $fuel['fuel'];}?>;
        let requiredFuel = <?
            $count = $connection->sum("user_objects", "fuel", ["user_id" => $_SESSION['user_data']['id']]);
                echo $count;?>;
        if (fuel < requiredFuel) {
            $(".danger-board").css("display", "block");
        } else if (fuel - requiredFuel <= requiredFuel) {
            $(".warning-board").css("display", "block");
        }


        $('#update').click(function(e){
            e.preventDefault();
            let requirement = <? $result = $connection->select("storage", ["requirement"], ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $farm) { echo $farm['requirement'];}?>*2;
            let size = <? $result = $connection->select("storage", ["capacity"], ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $farm) { echo $farm['capacity']; }?>+200;
            showPopup('.question_update', 'Улучшить склад', 'Вы действительно хотите увеличить объем склада до '+size+'? Для улучшения требуется ' + requirement + ' материалов');
        });



        $('#question_update').click(function(e){
        e.preventDefault();
        $('.question_update').fadeOut();

        let requirement = <? $result = $connection->select("storage", ["requirement"], ["user_id" => $_SESSION['user_data']['id']]);
                foreach($result as $farm) { echo $farm['requirement'];}?>*2;
        let size = <? $result = $connection->select("storage", ["capacity"], ["user_id" => $_SESSION['user_data']['id']]);
            foreach($result as $farm) { echo $farm['capacity']; }?>+200;
        $.ajax({
            url: '/request/update_storage.php',
            type: 'POST',
            dataType: 'json',
            data: {
                requirement: requirement,
                size: size,
            },
            success: function(data) {
                if (data['status'] === true) {
                    showPopup('.confirm_update', data['title']);
                    $('b.material').text(data['size'] + ' шт.');
                    $('b.level').text(data['size'] + ' шт.');
                } else {
                    showPopup('.error_update', data['title']);
                }
            }
            });
        });
    });
</script>