function AutoScroll(obj) {
    $(obj).find("ul:first").animate({
        marginTop: "-25px"
    }, 500, function() {
        $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
    });
}
$(document).ready(function() {
    var myar = setInterval('AutoScroll(".scrollDiv")', 3000)
    $(".scrollDiv").hover(function() { clearInterval(myar); }, function() { myar = setInterval('AutoScroll(".scrollDiv")', 3000) }); 
});