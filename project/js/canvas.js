window.count = 0;
function loadCanvas(data) {
    canvas1 = document.getElementById('layout1');
    canvas2 = document.getElementById('layout2');
    canvas3 = document.getElementById('layout3');
    obCanvas1 = canvas1.getContext('2d');
    obCanvas2 = canvas2.getContext('2d');
    obCanvas3 = canvas3.getContext('2d');

    obCanvas1.clearRect(0, 0, canvas1.width, canvas1.height);
    obCanvas2.clearRect(0, 0, canvas2.width, canvas2.height);
    obCanvas3.clearRect(0, 0, canvas3.width, canvas3.height);

    function circle(x, y) {
        obCanvas2.beginPath();
        obCanvas2.arc(y, x, 50, 0, 2 * Math.PI, false);
        obCanvas2.fillStyle = 'rgba(66, 209, 0, 0.2)';
        obCanvas2.fill();
    }

    function rec() {
        obCanvas3.beginPath();
        obCanvas3.arc(0, 0, 1000, 0, 2 * Math.PI, false);
        obCanvas3.fillStyle = 'rgba(247, 247, 5,0.5)';
        obCanvas3.fill();
    }

    var img = new Image();   // Создать новый объект Image
    window.count = 0;
    img.src = window.src;
    img.onload = function () {
        obCanvas1.drawImage(img, 0, 0);
        var obj = JSON.parse(data);
        for (var key in obj) {
            for (var i = 0; i < obj[key].length; i++) {
                circle(obj[key][i].y, obj[key][i].x);
                window.count++;
            }
        }
        rec();
        obemOXX();
    }
}


function placeMarkerAndPanTo(latLng, map) {
    var marker = new google.maps.Marker({
        position: latLng,
        map: map
    });
    map.panTo(latLng);
}

function obemOXX() {

    map.addListener('click', function (e) {
        placeMarkerAndPanTo(e.latLng, map);
    });

    var weight = 169 * 50 / 1000;
    var height = 169 * 50 / 1000;
    var plos = weight * height;
    var obem = plos * 20;
    window.obem = 0;
    $("#obmOxx").remove();

    $("#deleteMarkerAndSend").on("click", function () {
        var person = prompt("введите свой email для отпраки сертефеката");
        if (person != null) {
           document.location.href = "http://10.116.118.52:8181/email/"+person;
        }
    });
    $("#deleteMarkerAndSend").css({"background": "red"});
    $("#modal").append("<div id='obmOxx'><div id='neobh'>Необходимый процент кислорода:21%</div><div id='nash'><div id='text'>Содержание килорода в данной области</div><div id='pocaz'></div></div><div id='bue'>Расставте маркеры на карте и нажмите кнопку купить!</div></div>");
    setInterval(function () {
        if (((window.count) / obem ).toFixed(0) != 0) {
            if (((window.count) / obem ).toFixed(0) > window.obem) {
                $('#obmOxx').find('#nash').find("#pocaz").text(window.obem + "%");
                window.obem++;
            }
        } else {
            if (10 > window.obem) {
                $('#obmOxx').find('#nash').find("#pocaz").text(window.obem + "%");
                window.obem++;
            }
        }
    }, 150);


}
