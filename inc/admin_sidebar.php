<script type="text/javascript">
// DISABLE LINKS
    $(function() {
    $('#sidebar li a').each(function() {
        if(document.location.pathname == $(this).attr('href')) {
            $(this).addClass('disabled');
        }
    });
});
</script>
<?
// GET SEASON & DAYS INFORMATION
    require_once 'request/db.php';
    $result = $connection->select("rules", "*");
    foreach($result as $rules) {
        $season = $rules['season'];
        $days = $rules['days'];
    }
?>
<nav id="sidebar" style="min-height: 90vh;">
    <ul class="list-unstyled components">
        <li style="padding: 0; display: flex; justify-content: space-between;">
            <b style="font-family: 'Open Sans', sans-serif;"><?= $_SESSION['admin_data']['username']?></b><a href="/request/logout.php" style="text-decoration: underline;">Выйти</a>
        </li>    
        <div class="time">
            <div class="row"><i style="font-style: normal;">Время: </i><b id="clock"></b></div>
            <div class="row"><i style="font-style: normal;">Сезон: </i><b id="season">
                <?
                    switch($season){  
                        case "summer": echo 'Лето'; break;
                        case "spring": echo 'Весна'; break;
                        case "autumn": echo 'Осень'; break; 
                    default: echo 'Зима';
                    
                    }
                ?>
            </b></div>
            <div class="row"><i style="font-style: normal;">До окончания: </i><b id="days"><?= $days?> дн</b></div>
        </div>
        <hr style="background: #4B4B4B;">
    </ul>
    <ul class="list-unstyled components">
		<p>Управление</p>
        <li>
            <a class="nav-link" href="/admin/admin-list"><i class="fas fa-users-cog"></i>Администраторы</a>
        </li>
        <li>
            <a class="nav-link" href="/admin/users"><i class="fas fa-users"></i>Пользователи</a>
        </li>
        <li>
            <a class="nav-link" href=""><i class="fas fa-analytics"></i>Статистика</a>
        </li>
        <li>
            <a class="nav-link" href="/admin/logs"><i class="fas fa-bars"></i>Логи</a>
        </li>
        <li>
            <a class="nav-link" href="/admin/ban-list"><i class="fas fa-ban"></i>Блокировка</a>
        </li>
        <hr style="background: #4B4B4B;">
    </ul>
</nav>
<script type="text/javascript">
// CLOCK
const wAjax=(_url)=>{
    return new Promise((resolve)=>{
        $.ajax({
            url: _url,
            type: 'GET',
            async: true,
        }).done((r)=>{
            if(!r)r = false;
            resolve(r);
        }).catch((e)=>{
            console.log(e.status, e.responseText, e);
            resolve(false);
        });
    });
};
(async()=>{
    let x = await wAjax('https://time100.ru/api.php');
    let date = new Date(x * 1000);
    var hours = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();
    function clock() {
        sec+=1;
        if (sec>=60)
        {
            min+=1;
            sec=0;
        }
        if (min>=60)
        {
            hours+=1;
            min=0;
        }
        if (hours>=24)
            hours=0;
        if (sec<10)
            sec2display = "0"+sec;
        else
            sec2display = sec;


        if (min<10)
            min2display = "0"+min;
        else
            min2display = min;

        if (hours<10)
            hour2display = "0"+hours;
        else
            hour2display = hours;

        // UPDATE DAYS
        if (hour2display == '00' && min2display == '00' && sec2display == '05') {
            window.location.reload(); 
        }
        document.getElementById("clock").innerHTML = hour2display+":"+min2display+":"+sec2display;
    }
    setInterval(clock, 1000);
    clock();
})();
</script>
