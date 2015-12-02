// ruf die Funktion init nach dem fertigen Laden der Seite auf
window.addEventListener('load', init, false);

// ruft alle weiteren Funktionen auf
function init() {

    // Slider-Carousel für Background wird initialisiert
    new SliderCarousel({
        elementId: "background-carousel",
        autoSlide: true
    });

    // Slider-Carousel für Bild-Upload wird initialisiert
    new SliderCarousel({
        elementId: "article-carousel",
        autoSlide: false
    });

    scrollNav();
    // Startet Header-Scrollfunktion

    tablefilter.init("search-bar");
    // Startet den Suchfilter für Artikeltabelle

    map.init();
    // startet die Google-Map

    // Alle Labels aus dem Formular in Variable speichern, um sie später zu durchlaufen
    var labels = document.getElementsByTagName('LABEL');

    // Alle Labels werden durchlaufen
    for (var i = 0; i < labels.length; i++) {
        if (labels[i].htmlFor != '') {// haben Labels ein for mit ID des Input Feldes?
            var elem = document.getElementById(labels[i].htmlFor);
            // Wir holen uns das passende Input Feld
            if (elem)// Gibt es Input Feld mit dieser ID?
                elem.label = labels[i];
            // Wenn ja: Wir erfahren, welches Label zu welchem Input Feld gehört -> Verbindung
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

    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop; // Scrollposition des Users
    var height = document.getElementById("article-top").offsetHeight; // Höhe des Bildes holen
    var header = document.getElementsByTagName("header")[0]; // Header holen

    if (scrollTop > height) { // Scroll Position größer als das Bild -> small Klasse im CSS // wird beim Neuladen als erstes überprüft
        header.className = "small";
    }

    window.addEventListener("scroll", function () { // Event reagiert auf Scrolling, wird immer wieder ausgeführt
        scrollTop = document.body.scrollTop || document.documentElement.scrollTop; // Scroll Position holen
        if (scrollTop > height) {
            header.className = "small";
        } else {
            header.className = ""; // falls User wieder über das Bild nach oben scrollt -> Header wieder groß
        }
    });
}

// filtert die Tabele nach gesuchten Begriffe
var tablefilter = new function () {


    this.filter = function () {

        var words = this.value.toLowerCase().split(" "), // eingabe in words speichern als array
            table = document.getElementById(this.dataset.table), // holt die Tabelle
            ele = null; // Hilfsvariable

        for (var r = 1; r < table.rows.length; r++) { // Zeilen durchlaufen
            ele = table.rows[r].innerHTML.replace(/<[^>]+>/g, ""); // Alle tags löschen, Inhalt bleibt
            var className = 'hide'; // Zeile verstecken

            for (var i = 0; i < words.length; i++) { // Wörter im array durchlaufen
                if (ele.toLowerCase().indexOf(words[i]) >= 0) // Wenn ein Wort in der Zeile existiert
                    className = 'show'; // Klassenname = show
                else {
                    className = 'hide'; // Klassenname = hide
                    break; // ein nicht gefundenes Wort: Zeile wird verborgen
                }
            }
            table.rows[r].className = className; // Klassennamen vergeben
        }
    };


    this.init = function (elementId) {
        var input = document.getElementById(elementId); // unsere search-bar
        var form = input.parentElement; // unser Formular

        // Submit Abfangen und nicht Ausführen, egal ob Enter oder Suchen-Klick
        if (form.nodeName === "FORM") {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                return false;
            }, false);
        }

        input.addEventListener("keyup", this.filter, true); // keyup event, this filter wird oben aufgerufen
    };

};
