// TIMER
function two(a) {
    return (9 < a ? "" : "0") + a
}
function formatTime(a) {
    a = Math.floor(a / 1E3);
    var c = Math.floor(a / 60),
        d = Math.floor(c / 60);
    a %= 60;
    c %= 60;
    return two(d) + ":" + two(c) + ":" + two(a)
}
function Time() {
    var a = new Date, c = [7, 15, 23, 7], d = [], e = a.getDate() + 1, b = 0, m = -240 - a.getTimezoneOffset();
    for (; b < c.length; b++)
    a.setHours(c[b], m, 0, 0),
    3 == b && a.setDate(e),
    d[b] = a.getTime();
    for (b = 0; b < c.length && !(a = d[b] - (new Date).getTime(), 0 < a); b++);
    document.getElementById("timer").innerHTML = formatTime(a);
    window.setTimeout(Time, 1E3)
};
Time()