(function (document) {
    'use strict';

    window.onscroll = function () {

        var height = document.getElementById('article-top').offsetHeight;
        var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

        if (scrollTop > height) {
            document.getElementsByTagName("header")[0].className = "active";
        } else if (scrollTop > 10) {
            document.getElementsByTagName("header")[0].className = "transparent-active";
        } else {
            document.getElementsByTagName("header")[0].className = "transparent";
        }
    };

    /*setTimeout(function () {
        document.getElementById("helper-modal").style.display = "block";
    }, 500);*/

    var tablefilter = new function() {

        this.filter = function(){

            var words = this.value.toLowerCase().split(" ");
            var table = document.getElementsByClassName(this.dataset.table);
            var ele;

            for (var r = 1; r < table[0].rows.length; r++){
                ele = table[0].rows[r].innerHTML.replace(/<[^>]+>/g,"");
                var className = 'hide';

                for (var i = 0; i < words.length; i++) {
                    if (ele.toLowerCase().indexOf(words[i])>=0)
                        className = 'show';
                    else {
                        className = 'hide';
                        break;
                    }
                }
                table[0].rows[r].className = className;
            }
        },

        this.init = function(elementId){
            var input =  document.getElementById(elementId);
            input.addEventListener("keyup", this.filter, true);
        }

    };

    tablefilter.init("search-bar");



})(document);