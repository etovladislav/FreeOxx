function hideNg() {
    $(".tag-text").fadeOut();
    $("#start-page").fadeOut();
    $("#text").animate({"top": "55px", "left": "-18%"}, 500);
    setTimeout(function () {
        $("#input-group").css({"background": "rgba(0,0,0,0.5)"});
    }, 500);
    $("#analiz").css({"display": "block"});
    $("#analiz").animate({"opacity": "1"}, 200);
}
$("#input-search").on("click", function () {
    var address = $("input[name='search-google-maps']").val();
    hideNg();
    codeAddress(address);
});

$("#cart-button").on("click", function () {
    hideNg();
});

$("#google-static-maps").on("click", function () {
    $('#modal').fadeOut(500);
});

function showModal(data) {
    $('#modal').fadeIn(500);
    progressBar(100, $("#progressBar"));
    setTimeout(function () {
        $('#progressBar').fadeOut(500);
        $('#modal').draggable();
        loadCanvas(data);
        progressBar(0, $("#progressBar"));
    }, 500);
}
window.src = "";
function progress() {
    if (window.time < 3) {
        $('#progressBar').fadeIn(500);
        progressBar(window.procent, $("#progressBar"));
        window.time++;
        window.procent = window.procent + 30;
    }
}
$("#analiz").on("click", function () {
    window.time = 0;
    window.procent = 30;
    progress();
    setTimeout(function () {
        progress();
    }, 5000);

    $('#modal').fadeOut(500);
    window.src = 'http://maps.googleapis.com/maps/api/staticmap?center=' + window.lat + ',' + window.lng + '&zoom=16&&format=jpg&size=640x640&key=AIzaSyC1idurTZsZYGk_nGgCuxtJBeqRAt5rIlc';
    try {
        $.ajax({
            type: "POST",
            url: "/controller/imageController.php",
            data: {url: window.src},
            success: function (data) {
                showModal(data);
                console.log(data[5])
            }
        });
    } catch (err) {
        alert(err);
    }
});