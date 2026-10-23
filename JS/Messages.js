// This javascript file is used to display messages in an alert box
// It reads the message from a hidden HTML element with id: pageMessage
function showPageMessage () {
    // Get the hidden element that stores the message text
    var msgElement = document.getElementById("pageMessage");
    // If the element exists and has some text, show it in an alert box
    if (msgElement != null) {
        var text = msgElement.value;
        if (text != "") {
            alert(text);
        }
    }
}
// Call this method when the page is loaded
window.onload = showPageMessage;