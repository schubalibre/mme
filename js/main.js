// ruf die Funktion init nach dem fertigen Laden der Seite auf
window.addEventListener('load', init, false);

// ruft alle weiteren Funktionen auf
function init() {

	// Slider-Carousel für Background wird initialisiert
	new SliderCarousel({
		elementId : "background-carousel",
		autoSlide : true
	});
	
	// Slider-Carousel für Bild-Upload wird initialisiert
	new SliderCarousel({
		elementId : "article-carousel",
		autoSlide : false
	});

	scrollNav(); // Startet Header-Scrollfunktion

	tablefilter.init("search-bar"); // Startet den Suchfilter für Artikeltabelle
	
	map.init(); // startet die Google-Map

	// Alle Labels aus dem Formular in Variable speichern, um sie später zu durchlaufen
	var labels = document.getElementsByTagName('LABEL');

	// Alle Labels werden durchlaufen
	for (var i = 0; i < labels.length; i++) {
		if (labels[i].htmlFor != '') {// haben Labels ein for mit ID des Input Feldes?
			var elem = document.getElementById(labels[i].htmlFor);
			// Wir holen uns das passende Input Feld
			if (elem)// Gibt es Input Feld mit dieser ID?
				elem.label = labels[i];
			// Wenn ja: Wir erfahren, welches Label zu welchem Input Feld gehört
		}
	}

	//wir holen uns unser Formular
	var form = document.getElementById("article-form");
	// Browser-eigene Validation ausschalten da diese vor dem submit ausgefürht werden - um unsere eigenen Kontrollen durchzuführen
	form.noValidate = true;

	// beim Abschicken des Formulares wird unsere Funktion validateForm ausgeführt - um die eigenen Kontrollen durchzuführen
	form.addEventListener("submit", validateForm);
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

if (form.nodeName === "FORM") {
form.addEventListener('submit', function (event) {
event.preventDefault();
return false;
}, false);
}

input.addEventListener("keyup", this.filter, true);
};
};
