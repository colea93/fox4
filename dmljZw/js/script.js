var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? '' : sParameterName[1].replace('/', '');
        }
    }
    return '';
};


$(document).ready(function(){

    window.onbeforeunload = function(){
        return true;
    }
    
    $(".circle-container li").click(function (e){
        aHref.onclick = function(){
            window.onbeforeunload = function(){}
            location.href = aHref.href;
            return false;
        }
    });
});
