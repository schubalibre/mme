// ruf die Funktion init nach dem fertigen Laden der Seite auf
window.addEventListener('load', init, false);

// rut alle weiteren Funktionen auf
function init() {

	var slider = new SliderCarousel({
		elementId : "background-carousel",
		autoSlide : true
	});

	var article = new SliderCarousel({
		elementId : "article-carousel",
		autoSlide : false
	});

	scrollNav();
	initMap();
	tablefilter.init("search-bar");

	checkInputNotEmpty("name", "Bitte einen Artikelnamen eingeben.");
	checkInputNotEmpty("description", "Bitte eine Artikelbeschreibung hinzufügen.");
	checkInputNotEmpty("price", "Bitte den Preis in Euro angeben.");
	checkInputNotEmpty("width", "Bitte die Breite in cm angeben.");
	checkInputNotEmpty("height", "Bitte die Höhe in cm angeben.");
	checkInputNotEmpty("shop", "Bitte den Link zum Shop eintragen.");
	checkInputNotEmpty("address", "Bitte die Adresse des Shops eingeben.");
	checkInputNotEmpty("file", "Kein Bild ausgewählt.");
	checkInputNotEmpty("category", "Bitte eine Produktkategorie auswählen.");
}

function checkInputNotEmpty(elementID, errorMsg) {

	var nameInput = document.getElementById(elementID);
	nameInput.addEventListener("invalid", (function(e) {
		if (nameInput.validity.valueMissing) {
			nameInput.className = nameInput.className + " error";
			e.target.setCustomValidity(errorMsg);
		} else if (nameInput.type == "select-one") {
			if (nameInput.value != "") {
				nameInput.className = nameInput.className + " error";
				e.target.setCustomValidity(errorMsg);
			}
		}
	}), false);
	// blur = wenn man aus dem Feld geht
	nameInput.addEventListener("blur", (function(e) {
		// trim = schneidet lücken vor und nach dem String ab
		if (nameInput.value.trim() == "") {
		nameInput.className = nameInput.className + " error";
		console.log(nameInput.setCustomValidity(errorMsg));
		}
	}),false);
	
	nameInput.addEventListener("input", (function(e) {
		e.target.setCustomValidity("");
			nameInput.className = nameInput.className.replace(" error", "");
	}),false);
}

// wenn wir über unser Titelbild herausscrollen wird die nav Leiste verkleinert
function scrollNav() {

	var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
	var height = document.getElementById("article-top").offsetHeight;
	var header = document.getElementsByTagName("header")[0];

	if (scrollTop > height) {
		header.className = "small";
	}

	window.addEventListener("scroll", function() {
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
		zoom : 11,
		center : {
			lat : 52.5167,
			lng : 13.3833
		}
	});
	var geocoder = new google.maps.Geocoder();

	document.getElementById('address').addEventListener('keyup', function() {
		geocodeAddress(geocoder, map);
	});
}

// ermöglicht das Suchen von Adressen und gibt Vorschlaege
function geocodeAddress(geocoder, resultsMap) {

	var input = document.getElementById('address'), address = input.value, datalist = document.getElementById("mapResult");

	if (address.length > 3) {
		geocoder.geocode({
			'address' : address
		}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {

				input.style.borderColor = "#999";
				// reset all list elements
				datalist.innerHTML = '';
				datalist.style.display = "block";

				for (var i = 0; i < results.length; i++) {
					var option = document.createElement("option");
					option.setAttribute('data-id', i);
					option.value = results[i].formatted_address;
					option.appendChild(document.createTextNode(results[i].formatted_address));
					option.addEventListener('click', function(target) {
						var id = this.dataset.id;
						setMarker(resultsMap, results[id]);
						input.value = results[id].formatted_address;
						datalist.style.display = "none";
					}, false);

					datalist.appendChild(option);

					if (i >= 10)
						break;
					// not more than 10
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

	if ( typeof marker != "undefined")
		marker.setMap(null);

	resultsMap.setCenter(result.geometry.location);

	marker = new google.maps.Marker({
		map : resultsMap,
		position : result.geometry.location
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
};
};

// generiert das SilderCarousel
( function() {

		this.SliderCarousel = function() {

			// Create global element references
			this.carousel = null;
			this.carouselClass = null;
			this.ankers = [];
			this.activeSlide = null;
			this.nextSlide = null;
			this.prevSlide = null;
			this.clickable = true;
			this.interval = null;

			// Define option defaults
			var defaults = {
				elementId : "slider-carousel",
				autoSlide : false,
				autoDelay : 5000
			};

			// Create options by extending defaults with the passed in arugments
			if (arguments[0] && typeof arguments[0] === "object") {
				this.options = extendDefaults(defaults, arguments[0]);
			}

			this.start();

			return this;

		};

		SliderCarousel.prototype.start = function() {
			this.carousel = document.getElementById(this.options.elementId);
			this.carousel.className = this.carousel.className + " slider-carousel";
			this.carouselClass = this.carousel.className;
			generateCarousel.call(this);

			if (this.options.autoSlide)
				autoStart.call(this);
		};

		function autoStart() {
			var _self = this;
			_self.interval = window.setInterval(nextSlideAction.bind(_self), _self.options.autoDelay);
		}

		function nextSlideClick() {
			var _self = this;
			clearInterval(_self.interval);
			nextSlideAction.call(_self);
			if (this.options.autoSlide)
				autoStart.call(this);
		}

		function prevSlideClick() {
			var _self = this;
			clearInterval(_self.interval);
			prevSlideAction.call(_self);
			if (this.options.autoSlide)
				autoStart.call(this);
		}

		function nextSlideAction() {
			var _self = this;

			if (!_self.clickable)
				return false;

			_self.clickable = false;

			_self.carousel.className = _self.carouselClass + " nextSlide";

			var active = _self.ankers[_self.activeSlide];
			active.className = "slider prev";
			active.addEventListener('transitionend', function() {
				_self.carousel.className = _self.carouselClass;
				_self.clickable = true;

			}, false);

			var next = _self.ankers[_self.nextSlide];
			next.className = "slider active";

			var prev = _self.ankers[_self.prevSlide];
			prev.className = "slider";

			var newNext = _self.ankers[(_self.nextSlide + 1 >= _self.ankers.length) ? 0 : _self.nextSlide + 1];
			newNext.className = "slider next";

			_self.prevSlide = _self.activeSlide;
			_self.activeSlide = _self.nextSlide;
			_self.nextSlide = (_self.nextSlide + 1 >= _self.ankers.length) ? 0 : _self.nextSlide + 1;

			return _self;
		}

		function prevSlideAction() {
			var _self = this;

			if (!_self.clickable)
				return false;

			_self.clickable = false;

			_self.carousel.className = _self.carouselClass + " prevSlide";

			var active = _self.ankers[_self.activeSlide];
			active.className = "slider next";
			active.addEventListener('transitionend', function() {
				_self.carousel.className = _self.carouselClass;
				_self.clickable = true;
			}, false);

			var next = _self.ankers[_self.nextSlide];
			next.className = "slider";

			var prev = _self.ankers[_self.prevSlide];
			prev.className = "slider active";

			var newPrev = _self.ankers[(_self.prevSlide - 1 < 0 ) ? _self.ankers.length - 1 : _self.prevSlide - 1];
			newPrev.className = "slider prev";

			_self.nextSlide = _self.activeSlide;
			_self.activeSlide = _self.prevSlide;
			_self.prevSlide = (_self.prevSlide - 1 < 0 ) ? _self.ankers.length - 1 : _self.prevSlide - 1;

			return _self;
		}

		function generateCarousel() {
			var _self = this;

			var carouselChildren = _toArray(_self.carousel.children);
			_self.carousel.innerHTML = null;

			var prev = document.createElement("a");
			prev.className = "nav-prev";
			prev.appendChild(document.createTextNode(""));
			prev.addEventListener('click', prevSlideClick.bind(_self), false);

			var next = document.createElement("a");
			next.className = "nav-next";
			next.appendChild(document.createTextNode(""));
			next.addEventListener('click', nextSlideClick.bind(_self), false);

			_self.carousel.appendChild(prev);

			Array.prototype.forEach.call(carouselChildren, function(children, i) {

				var anker = document.createElement("a"), img = new Image();

				img.setAttribute('src', children.getAttribute('src'));
				img.onload = function() {
					anker.style.backgroundImage = 'url(' + children.getAttribute('src') + ')';

					var className = anker.className = "slider";

					if (i == 0) {
						anker.className = className + " active";
						_self.activeSlide = i;
					} else if (i == 1) {
						anker.className = className + " next";
						_self.nextSlide = i;
					} else if (i == carouselChildren.length - 1) {
						anker.className = className + " prev";
						_self.prevSlide = i;
					}
				}.call(_self);

				_self.carousel.appendChild(anker);
				_self.ankers.push(anker);
			});

			_self.carousel.appendChild(next);

			return _self;
		}

		function _toArray(obj) {
			return Array.prototype.slice.call(obj);
		}

		function extendDefaults(source, properties) {
			var property;
			for (property in properties) {
				if (properties.hasOwnProperty(property)) {
					source[property] = properties[property];
				}
			}
			return source;
		}

	}());

