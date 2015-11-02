
window.addEventListener('load', init, false);

function init(){
    scrollNav();
    initMap();
}

function scrollNav(){

    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.getElementById("article-top").offsetHeight;
    var header = document.getElementsByTagName("header")[0];

    if(scrollTop > height) {
        header.className = "small";
    }

    window.addEventListener("scroll", function(){
        scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
        if(scrollTop > height){
            header.className = "small";
        }else {
            header.className = "";
        }
    });
}

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {lat: 52.5167, lng: 13.3833}
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('address').addEventListener('keyup', function() {
        geocodeAddress(geocoder, map);
    });
}

function geocodeAddress(geocoder, resultsMap) {

    var input = document.getElementById('address'),
        address = input.value;
    if (address.length > 3) {
        geocoder.geocode({'address': address}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                input.style.borderColor = "#999"
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                input.style.borderColor = "red";
            }
        });
    }
}

