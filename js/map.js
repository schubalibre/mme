var map = (function () {

    var input,
        map,
        geocoder,
        list,
        listItems = [],
        marker;

	// Adressvorschläge werden generiert
	// Klasse active in CSS füllt Feld grau aus & macht Schrift weiß
	// Reagiert auf alle Tasteneingaben außer: oben, unten, esc, enter
    var helpers = {
        generateList: function (results) {
            var active = "active"; // erstes Element grau hinterlegt
            for (var i = 0; i < results.length; i++) { // Results durchlaufen
                console.log(i);
                console.log(results[i]);
                var li = document.createElement('li'); // List Element
                li.className = active; // bekommt Klasse
                li.appendChild(document.createTextNode(results[i].formatted_address)); // bekommt Eintrag von Google
                li.result = results[i]; // Objekt mit Google-Referenz Index zuweisen
                li.myIndex = i;
                listItems.push(li); // list Elemente zwischenspeichern
                list.appendChild(li); // Mit in die Liste packen
                active = ""; 
            }
        },

        clickListener: function (option, result) {
            option.addEventListener('click', function (e) {
                e.preventDefault();
                callbacks.setMarker(map, result);
                input.value = result.formatted_address;
            }, false);
        },

        listNavigator: function (step) {

            var selected =  helpers._getSelectedItem();

            selected.className = "";

            var index = selected.myIndex;

            console.log(listItems[index]);

            if ((index + step) > 0 && (index + step) < listItems.length) {
                listItems[index + step].className = "active";
                listItems[index + step].focus();
            }

            return;
        },

        selectListItem: function () {

            var selected =  helpers._getSelectedItem();

            callbacks.setMarker(map, selected.result);
            input.value = selected.result.formatted_address;
        },

        closeList: function () {
            list.style.display = "none";
        },

        _getSelectedItem : function(){
            var selected;
            Array.prototype.forEach.call(listItems, function (item, i) {
                if (item.className == "active") {
                    selected = item;            }
            });

            return selected;
        }
    };

    var callbacks = {
        onClickInput: function (event) {

            event.preventDefault();

            switch (event.keyCode) {
                case 38: // up
                    helpers.listNavigator(-1);
                    return;
                case 40: // down
                    helpers.listNavigator(+1);
                    return;
                case 13: // enter
                    helpers.selectListItem();
                    return;
                case 27: // esc
                    helpers.closeList();
                    return;
            }

            callbacks.geocodeAddress();

            return false;
        },

        // ermöglicht das Suchen von Adressen und gibt Vorschlaege
        geocodeAddress: function () {
            var address = input.value;

            if (address.length > 3) {
                geocoder.geocode({
                    'address': address
                }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) { // Typvergleich ===
                        input.className = input.className.replace(" error", ""); // Error rausnehmen
                        list.textContent = ''; 
                        list.style.display = "block";
                        helpers.generateList(results); // Liste zur Eingabe von Google, Adress Ergebnisse
                    } else { // Google findet Adresse nicht, Vorschläge werden ausgeblendet, InputFeld bekommt error (CSS)
                        list.style.display = "none";
                        input.className = input.className + " error";
                    }
                });
            }
        },

        // setzt den Marker auf der GoogleKarte
        setMarker: function (map, result) {

            if (typeof marker != "undefined")
                marker.setMap(null);

            map.setCenter(result.geometry.location);

            marker = new google.maps.Marker({
                map: map,
                position: result.geometry.location
            });
        }

    };

    var module = {
        // initialisiert unsere Karte
        init: function () {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {
                    lat: 52.5167,
                    lng: 13.3833
                }
            });
            geocoder = new google.maps.Geocoder();
            input = document.getElementById('address');
            list = document.getElementById("mapResult");
            input.addEventListener('keyup', callbacks.onClickInput);
        }
    };

    return module;
}());
