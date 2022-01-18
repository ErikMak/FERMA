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


// (async()=>{
// 	function formatDate(date) {
// 	  var hours = date.getHours().toString();
// 	  if (hours.length < 2) hours = '0'+hours;
// 	  var minutes = date.getMinutes().toString();
// 	  if (minutes.length < 2) minutes = '0'+minutes;
// 	  var seconds = date.getSeconds().toString();
// 	  if (seconds.length < 2) seconds = '0'+seconds;
// 	  if (hours == '00' && minutes == '00' && seconds == '05') {
//             window.location.reload(); 
//       }
// 	  return hours+':'+minutes+':'+seconds;
// 	}
//     let x = await wAjax('https://time100.ru/api.php');
//     let date = new Date(x * 1000);
//     setInterval(function () {
//         date.setTime(date.getTime()+1000);
//         var wtime = formatDate(date);
//         document.getElementById("clock").innerHTML = wtime;
//     }, 1000);
// })();