// generiert das SilderCarousel
( function () {

    this.SliderCarousel = function () {

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
            elementId: "slider-carousel",
            autoSlide: false,
            autoDelay: 5000
        };

        // Create options by extending defaults with the passed in arugments
        if (arguments[0] && typeof arguments[0] === "object") {
            this.options = extendDefaults(defaults, arguments[0]);
        }

        start.call(this);

        return this;
    };

    function start () {
        var _self = this;
        _self.carousel = document.getElementById(_self.options.elementId);
        _self.carousel.className = this.carousel.className + " slider-carousel";
        _self.carouselClass = _self.carousel.className;
        generateCarousel.call(_self);

        if (this.options.autoSlide)
            autoStart.call(this);
    }

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
        active.addEventListener('transitionend', function () {
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
        active.addEventListener('transitionend', function () {
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

        Array.prototype.forEach.call(carouselChildren, function (children, i) {

            var anker = document.createElement("a"), img = new Image();

            img.setAttribute('src', children.getAttribute('src'));
            img.onload = function () {
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
