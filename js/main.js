window.onscroll = function(){

    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.getElementById("article-top").offsetHeight;
    var header = document.getElementsByTagName("header")[0];

    if(scrollTop > height){
        header.className = "small";
    }else {
        header.className = "";
    }

}