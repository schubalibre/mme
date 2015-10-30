window.onscroll = function(){

    if (document.body.scrollTop || document.documentElement.scrollTop > 10) {
        document.getElementsByTagName("header")[0].className = "active";
    } else {
        document.getElementsByTagName("header")[0].className = "transparent";
    }
};