//печатает тект
$(function () {
    $(".tag-text span").typed({
        stringsElement: $("#strig-print"),
        typeSpeed: 80,
        backDelay: 400,
        loop: false,
        contentType: "html",
        loopCount: false,
        callback: function () {
            $(".tag-text span:last-child").hide();
        }

    });
});

//googl maps
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('google-static-maps'), {
        center: {lat: 55.8304307, lng: 49.0660806},
        zoom: 16
    });

    map.addListener('click', function (e) {
        window.lat = e.latLng.lat()
        window.lng = e.latLng.lng()
    });

    var infoWindow = new google.maps.InfoWindow({map: map});

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
        }, function () {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
    codeAddress("Казань петербуржская 52");

}


function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Включите геолокацию в браузере' :
        'Ваш браузер не поддерживает геолокацию');
}
window.lat = 0;
window.lng = 0;
//поиск по адруссц
function codeAddress(address) {
    geocoder = new google.maps.Geocoder(); // геокодер
    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            window.lat = results[0].geometry.location.lat();
            window.lng = results[0].geometry.location.lng();
            map.setZoom(17);
        } else {

        }
    });
}
//прогресс бар
function progressBar(percent, $element){
    var progressBarWidth = percent * $element.width() / 100;
    $element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "%&nbsp;");
}
