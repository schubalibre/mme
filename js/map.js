var map = (function () {

    var input,
        map,
        geocoder,
        list,
        listItems,
        marker;

	// Adressvorschläge werden generiert
	// Klasse active in CSS füllt Feld grau aus & macht Schrift weiß
	// Reagiert auf alle Tasteneingaben außer: oben, unten, esc, enter
    var helpers = {
        generateList: function (results) {

            var active = "active"; // erstes Element grau hinterlegt
            listItems = [];
            for (var i = 0; i < results.length; i++) { // Results durchlaufen
                var li = document.createElement('li');
                li.className = active; // bekommt Klasse
                li.appendChild(document.createTextNode(results[i].formatted_address));
                li.addEventListener("click", helpers.clickListener,false); // bekommt Eintrag von Google
                li.result = results[i]; // Objekt mit Google-Referenz Index zuweisen
                li.myIndex = i;
                listItems.push(li); // list Elemente zwischenspeichern
                list.appendChild(li); // Mit in die Liste packen
                active = ""; 
            }
            // wir rufen unsere ListNavigation erst beim erstellen der Liste
            input.addEventListener('keydown', callbacks.onClickInput,false);
        },

        clickListener: function (event) {
            helpers.selectedItemHandler(event);
        },

        listNavigator: function (step) {

            var selected =  helpers._getSelectedItem();

            if(selected == null) return;

            var index = selected.myIndex;

            if ((index + step >= 0) && (index + step < listItems.length)) {
                selected.className = "";
                listItems[index + step].className = "active";
                list.scrollTop = (listItems[index + step].offsetTop - (list.offsetHeight - listItems[0].offsetHeight));
            }

        },

        selectedItemHandler: function (event) {

            var li = null;

            if(event == undefined){
                li =  helpers._getSelectedItem();
            }else{
                event.preventDefault();
                li = event.target;
            }

            if(li == undefined || li == null ) return null;

            var liResult = li.result;
            callbacks.setMarker(map, liResult);
            input.value = liResult.formatted_address;
            list.style.display = "none";

        },

        closeList: function () {
            list.style.display = "none";
            list.textContent = '';
            listItems = [];
            input.removeEventListener('keydown', callbacks.onClickInput,false);
        },

        _getSelectedItem : function(){
            var selected = null;
            Array.prototype.forEach.call(listItems, function (item) {
                if (item.className == "active") {
                    selected = item;
                }
            });

            return selected;
        }
    };

    var callbacks = {
        onClickInput: function (event) {

            switch (event.keyCode) {
                case 38: // up
                    helpers.listNavigator(-1);
                    event.preventDefault();
                    return false;
                case 40: // down
                    helpers.listNavigator(+1);
                    event.preventDefault();
                    return false;
                case 13: // enter
                    helpers.selectedItemHandler();
                    event.preventDefault();
                    return false;
                case 27: // esc
                    helpers.closeList();
                    return false;
            }
        },

        // ermöglicht das Suchen von Adressen und gibt Vorschlaege
        geocodeAddress: function (event) {

            var key = event.keyCode;

            if(key == 38 || key == 40|| key == 13 || key == 27 ) return;

            var address = input.value;

            if (address.length > 3) {
                geocoder.geocode({
                    'address': address
                }, function (results, status) {

                    if (status === google.maps.GeocoderStatus.OK) { // Typvergleich
                        input.className = "";
                        list.textContent = '';
                        list.style.display = "block";
                        helpers.generateList(results); // Liste zur Eingabe von Google, Adress Ergebnisse
                    } else { // Google findet Adresse nicht, Vorschläge werden ausgeblendet, InputFeld bekommt error (CSS)
                        input.className = "error";
                        helpers.closeList();
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

            input.addEventListener("focus",function(event){
                event.target.addEventListener('keyup', callbacks.geocodeAddress,false);
            },false);

            input.addEventListener("blur",function(event){
                event.target.removeEventListener('keyup', callbacks.geocodeAddress,false);
                helpers.closeList();
            },false);
        }
    };

    return module;
}());
