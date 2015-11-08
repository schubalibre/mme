window.addEventListener('load', init, false);

function init() {
    backgroundCarousel();
    scrollNav();
    initMap();
    tablefilter.init("search-bar");
}

function backgroundCarousel(){

    var div = document.getElementById("background-carousel"),
        ul = div.getElementsByTagName("ul"),
        lis = ul[0].getElementsByTagName("li");

    var x = 0;
    var interval = setInterval(function() {

        var i = div.scrollLeft;
        var scrollLeft = setInterval(function() {
            div.scrollLeft = i;
            i += 10;
            if(i >= lis[x].offsetLeft) clearInterval(scrollLeft)
        },1);

        x++;
        if(x>=lis.length){
            x=0;
            i=0;
        }

    }, 3000);
}

function scrollNav() {

    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.getElementById("article-top").offsetHeight;
    var header = document.getElementsByTagName("header")[0];

    if (scrollTop > height) {
        header.className = "small";
    }

    window.addEventListener("scroll", function () {
        scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
        if (scrollTop > height) {
            header.className = "small";
        } else {
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

    document.getElementById('address').addEventListener('keyup', function () {
        geocodeAddress(geocoder, map);
    });
}

function geocodeAddress(geocoder, resultsMap) {

    var input = document.getElementById('address'),
        address = input.value, ul = document.getElementById("mapResult");

    if (address.length > 3) {
        geocoder.geocode({'address': address}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {

                input.style.borderColor = "#999";

                // reset all list elements
                ul.innerHTML = '';
                ul.style.display = "block";

                for (var i = 0; i < results.length; i++) {
                    var li = document.createElement("li");
                    li.setAttribute('data-id', i);
                    li.appendChild(document.createTextNode(results[i].formatted_address));
                    li.addEventListener('click', function (target) {
                        var id = this.dataset.id;
                        setMarker(resultsMap, results[id]);
                        input.value = results[id].formatted_address;
                        ul.style.display = "none";
                    }, false);

                    ul.appendChild(li);

                    if (i >= 10) break; // not more than 10
                }
            } else {
                ul.style.display = "none";
                input.style.borderColor = "red";
            }
        });
    }
}

var marker;

function setMarker(resultsMap, result) {

    if(typeof marker != "undefined") marker.setMap(null);

    resultsMap.setCenter(result.geometry.location);

    marker = new google.maps.Marker({
        map: resultsMap,
        position: result.geometry.location
    });
}

var tablefilter = new function () {

    this.filter = function () {

        var words = this.value.toLowerCase().split(" "),
            table = document.getElementById(this.dataset.table),
            ele = null;

        for (var r = 1; r < table.rows.length; r++) {
            ele = table.rows[r].innerHTML.replace(/<[^>]+>/g, "");
            var className = 'hide';

            for (var i = 0; i < words.length; i++) {
                if (ele.toLowerCase().indexOf(words[i]) >= 0)
                    className = 'show';
                else {
                    className = 'hide';
                    break;
                }
            }
            table.rows[r].className = className;
        }
    },

    this.init = function (elementId) {
        var input = document.getElementById(elementId);
        input.addEventListener("keyup", this.filter, true);
    }

};

