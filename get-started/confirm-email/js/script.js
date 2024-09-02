var container = document.getElementsByClassName("confirm-wrapper")[0];
container.onkeyup = function(e) {
    var target = e.srcElement || e.target;
    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;
    if (myLength >= maxLength) {
        var next = target;
        while (next = next.nextElementSibling) {
            if (next == null)
                break;
            if (next.tagName.toLowerCase() === "input") {
                next.focus();
                break;
            }
        }
    }
    else if (myLength === 0) {
        var previous = target;
        while (previous = previous.previousElementSibling) {
            if (previous == null)
                break;
            if (previous.tagName.toLowerCase() === "input") {
                previous.focus();
                break;
            }
        }
    }
}
