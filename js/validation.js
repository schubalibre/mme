function validateForm(event) {
	
	var scrolling = false; // wurde schon zu einem Element gescrollt?

	// Zugriff auf das event für alle Browser
	event = ( event ? event : window.event);

	// Zugriff auf das form-Element für alle Browser
	var form = (event.target ? event.target : event.srcElement), f, field, formvalid = true;

	// Alle Input-Felder, Select, Textarea werden durchlaufen, für späteren Zugriff

	for ( f = 0; f < form.elements.length; f++) {

		// Holt sich das Feld an Stelle f
		field = form.elements[f];

		// Buttons etc. ignorieren
		if (field.nodeName !== "INPUT" && field.nodeName !== "TEXTAREA" && field.nodeName !== "SELECT")
			continue;

		// willValidate fragt ab, ob Browserspezifische Validierung vorhanden
		// wenn existent, dann führe Validation aus
		if ( typeof field.willValidate !== "undefined") {
			// Überprüfung pro Feld starten
			field.checkValidity();
		}
		
		// Wir speichern erstes Element der Liste in span
		var span = field.label.getElementsByClassName("error")[0];
		
		
		if (span == undefined) { // noch kein span im Label
			span = document.createElement("span"); // neues span kreieren
			span.className = "error"; // bekommt class-name error
			field.label.appendChild(span); // ins Label reinpacken
		}

		span.innerHTML = ""; // span wird als leer überschrieben, weil evt. Validierung korrekt
		field.className = ""; // class name "error" nicht mehr erforderlich, weil evt. Feld richtig

		if (!field.validity.valid) { // immer noch nicht validiert?

			// Input-Feld / Select etc. bekommt class-name "error"
			field.className = "error";


			// Möglicher Fehler werden abgefangen und mit Fehlermeldung ans Label gehangen
			// Span Element mit Klasse error wird mit Error-Nachricht befüllt
			// siehe HTML: z.B. data-error-value-missing
			if (field.validity.valueMissing) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorValueMissing));
			} else if (field.validity.patternMismatch) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorPatternMismatch));
			} else if (field.validity.badInput) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorBadInput));
			} else if (field.validity.customError) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorCustomError));
			} else if (field.validity.stepMismatch) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorStepMismatch));
			} else if (field.validity.rangeOverflow) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorRangeOverflow));
			} else if (field.validity.rangeUnderflow) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorRangeUnderflow));
			} else if (field.validity.patternMismatch) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorPatternMismatch));
			} else if (field.validity.tooLong) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorTooLong));
			} else if (field.validity.tooShort) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorTooShort));
			} else if (field.validity.typeMismatch) {
				span.appendChild(document.createTextNode(" - " + field.dataset.errorTypeMismatch));
			}

			if (!scrolling) { // Sprung zum ersten fehlerhaften Feld
				window.scroll(0, field.offsetTop - 120); // nicht zu hoch (Header)
				field.focus(); // setzt den Coirser in das betroffene Feld
				scrolling = true;
			}

			// Fomular soll nicht abgeschickt werden!
			formvalid = false;
		}

		// Sobald zur Laufzeit erneut ins Feld geklickt wird, wird error-klasse und error-Nachricht gelöscht
		field.addEventListener("focus", (function(event) {
			event.target.className = "";
			event.target.label.getElementsByClassName("error")[0].innerHTML = "";
		}), false);

	}

	// Das Formular wird nicht abgeschickt, wenn formvalid false ist
	if (!formvalid) {
		if (event.preventDefault) // Unterbinde die Absendefunktion an den Browser
			event.preventDefault();
	} // wenn Formular fehlerhaft = false
	return formvalid;
} 
