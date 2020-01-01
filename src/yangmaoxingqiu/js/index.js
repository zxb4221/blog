document.addEventListener('DOMContentLoaded', function () {
window.smoothScrollToTop = (function () {
        var timeOut;
        var speed;
        return function scrollToTop() {
            speed = speed || document.body.scrollTop/25;
            if (document.body.scrollTop || document.documentElement.scrollTop){
                window.scrollBy(0, -1*speed);
                timeOut = setTimeout(scrollToTop, 0);
            }
            else {
                clearTimeout(timeOut);
                speed = null;
            }
        };
    })();
});