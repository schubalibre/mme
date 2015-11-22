
function validateForm(event) {

    var labels = document.getElementsByTagName('LABEL'),scrolling = false;

    // fetch cross-browser event object and form node
    event = (event ? event : window.event);

    var form = (event.target ? event.target : event.srcElement),
        f, field, formvalid = true;

    // loop all fields

    for (f = 0; f < form.elements.length; f++) {

        // get field
        field = form.elements[f];

        // ignore buttons, fieldsets, etc.
        if (field.nodeName !== "INPUT" && field.nodeName !== "TEXTAREA" && field.nodeName !== "SELECT") continue;

        // is native browser validation available?
        if (typeof field.willValidate !== "undefined") {
            // native browser check
            field.checkValidity();
        }


        for (var i = 0; i < labels.length; i++) {
            if (labels[i].htmlFor != '') {
                var elem = document.getElementById(labels[i].htmlFor);
                if (elem)
                    elem.label = labels[i];
            }
        }

        var span = field.label.getElementsByClassName("error")[0];

        if(span == undefined){
            span = document.createElement("span");
            span.className = "error";
            field.label.appendChild(span)
        }

        span.innerHTML = "";

        if (field.validity.valid) {

            // remove error styles and messages

            field.className = "";

        } else {

            // style field, show error, etc.

            field.className = "error";

            if (!scrolling) {
                window.scroll(0, field.offsetTop - 120);
                scrolling = true;
            }

            if(field.validity.valueMissing){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorValueMissing));
            }else if(field.validity.patternMismatch){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorPatternMismatch));
            }else if(field.validity.badInput){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorBadInput));
            }else if(field.validity.customError){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorCustomError));
            }else if(field.validity.stepMismatch){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorStepMismatch));
            }else if(field.validity.rangeOverflow){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorRangeOverflow));
            }else if(field.validity.rangeUnderflow){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorRangeUnderflow));
            }else if(field.validity.patternMismatch){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorPatternMismatch));
            }else if(field.validity.tooLong){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorTooLong));
            }else if(field.validity.tooShort){
                span.appendChild(document.createTextNode(" - " + field.dataset.errorTooShort));
            }else if(field.validity.typeMismatch) {
                span.appendChild(document.createTextNode(" - " + field.dataset.errorTypeMismatch));
            }

            // form is invalid
            formvalid = false;
        }


        field.addEventListener("change",(function(event){
            event.target.className = "";
            event.target.label.getElementsByClassName("error")[0].innerHTML = "";
        }),false);

    }

    // cancel form submit if validation fails
    if (!formvalid) {
        if (event.preventDefault) event.preventDefault();
    }
    return formvalid;
}
