// ruf die Funktion init nach dem fertigen Laden der Seite auf
window.addEventListener('load', init, false);

// rut alle weiteren Funktionen auf
function init() {
    var slider =  new sliderCarousel();
    slider.init("background-carousel");

    var article =  new sliderCarousel();
    article.init("article-carousel");


    scrollNav();
    initMap();
    tablefilter.init("search-bar");

}

// wenn wir über unser Titelbild herausscrollen wird die nav Leiste verkleinert
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

// initialisiert unsere Karte
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

// ermöglicht das uchen von Adressen und gibt Vorschläge
function geocodeAddress(geocoder, resultsMap) {

    var input = document.getElementById('address'),
        address = input.value,
        datalist = document.getElementById("mapResult");

    if (address.length > 3) {
        geocoder.geocode({'address': address}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {

                input.style.borderColor = "#999";
                // reset all list elements
                datalist.innerHTML = '';
                datalist.style.display = "block";

                for (var i = 0; i < results.length; i++) {
                    var option = document.createElement("option");
                    option.setAttribute('data-id', i);
                    option.value=results[i].formatted_address;
                    option.appendChild(document.createTextNode(results[i].formatted_address));
                    option.addEventListener('click', function (target) {
                        var id = this.dataset.id;
                        setMarker(resultsMap, results[id]);
                        input.value = results[id].formatted_address;
                        datalist.style.display = "none";
                    }, false);

                    datalist.appendChild(option);

                    if (i >= 10) break; // not more than 10
                }
            } else {
                datalist.style.display = "none";
                input.style.borderColor = "red";
            }
        });
    }
}

var marker;
// setzt den Marker auf der GoogleKarte
function setMarker(resultsMap, result) {

    if(typeof marker != "undefined") marker.setMap(null);

    resultsMap.setCenter(result.geometry.location);

    marker = new google.maps.Marker({
        map: resultsMap,
        position: result.geometry.location
    });
}

// filtert die Tabele nach gesuchten Begriffe
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
    };

    this.init = function (elementId) {
        var input = document.getElementById(elementId);

        var form = input.parentElement;

        if(form.nodeName === "FORM"){
            form.addEventListener('submit',function(event){
                event.preventDefault();
                return false;
            },false);
        }

        input.addEventListener("keyup", this.filter, true);
    }
};

// generiert das SilderCarousel
function sliderCarousel(){

    var carousel = null,
        carouselClass,
        ankers = [],
        activeSlide,
        nextSlide,
        prevSlide,
        clickable = true;

    this.init = function(elementId){
        carousel = document.getElementById(elementId);
        carousel.className = carousel.className + " slider-carousel";
        carouselClass = carousel.className;
        this.generateCarousel();
    };

    this.nextSlideAction = function(){

        if (!clickable) return false;

        clickable = false;

        carousel.className = carouselClass + " nextSlide";

        var active = ankers[activeSlide];
        active.className = "slider prev";
        active.addEventListener('transitionend', function () {
            carousel.className = carouselClass;
            clickable = true;
        }, false);

        var next = ankers[nextSlide];
        next.className = "slider active";

        var prev = ankers[prevSlide];
        prev.className = "slider";

        var newNext = ankers[(nextSlide + 1 >= ankers.length) ? 0 : nextSlide + 1];
        newNext.className = "slider next";

        prevSlide = activeSlide;
        activeSlide = nextSlide;
        nextSlide = (nextSlide + 1 >= ankers.length) ? 0 : nextSlide + 1;

        return false
    };

    this.prevSlideAction = function() {

        if (!clickable) return false;

        clickable = false;

        carousel.className = carouselClass + " prevSlide";

        var active = ankers[activeSlide];
        active.className = "slider next";
        active.addEventListener('transitionend', function () {
            carousel.className = carouselClass;
            clickable = true;
        }, false);

        var next = ankers[nextSlide];
        next.className = "slider";

        var prev = ankers[prevSlide];
        prev.className = "slider active";

        var newPrev = ankers[(prevSlide - 1 < 0 ) ? ankers.length - 1 : prevSlide - 1];
        newPrev.className = "slider prev";

        nextSlide = activeSlide;
        activeSlide = prevSlide;
        prevSlide = (prevSlide - 1 < 0 ) ? ankers.length - 1 : prevSlide - 1;

        return false
    };

    this.generateCarousel = function(){
        var carouselChildren = this._toArray(carousel.children);
        carousel.innerHTML = null;

        var prev = document.createElement("a");
        prev.className = "nav-prev";
        prev.appendChild(document.createTextNode(""));
        prev.addEventListener('click',this.prevSlideAction,false);

        var next = document.createElement("a");
        next.className = "nav-next";
        next.appendChild(document.createTextNode(""));
        next.addEventListener('click',this.nextSlideAction,false);

        carousel.appendChild(prev);

        Array.prototype.forEach.call(carouselChildren, function(children, i) {
            var anker = document.createElement("a"),
                img = new Image();

            img.setAttribute('src', children.getAttribute('src'));
            img.onload = function() {

                anker.style.backgroundImage = 'url(' + children.getAttribute('src') + ')';

                anker.className = "slider";

                if(i == 0) {
                    anker.className = anker.className + " active";
                    activeSlide = i;
                }else if(i == 1){
                    anker.className = anker.className + " next";
                    nextSlide = i;
                }else if(i == carouselChildren.length - 1){
                    anker.className = anker.className + " prev";
                    prevSlide = i;
                }
            };

            carousel.appendChild(anker);
            ankers.push(anker);
        });

        carousel.appendChild(next);
    };

    this._toArray = function(obj) {
        return Array.prototype.slice.call(obj);
    };
};

