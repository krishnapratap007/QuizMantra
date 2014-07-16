<!DOCTYPE html>
<html>
<body onload="startTime()">
    <input type="button" onclick="setTimeout()" value="redirect" />
<div id="txt"></div>

<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById("txt").innerHTML = h+ ":" + m + ":" + s;
    t = setTimeout(function(){startTime()}, 500);
}

function checkTime(i) {
    if (i < 10) {
        i= "0" + i;
    }
    return i;
}


setTimeout(function () {
   window.location.href = "/PHP/ScienceRegistration/signin.php"; //will redirect to your blog page (an ex: blog.html)
}, 5000); //will call the function after 2 secs.

</script>

</body>
</html>
