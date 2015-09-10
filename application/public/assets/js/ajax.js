function switchElement(elementToHide, elementToShow) {
    $(elementToHide).hide();
    $("#" + elementToShow).fadeIn('slow');
    $("#" + elementToShow).css({display: 'inline'});
}

function switchElementById(elementToHide, elementToShow) {
    $("#" + elementToHide).hide();
    $("#" + elementToShow).fadeIn('slow');
    $("#" + elementToShow).css({display: 'inline'});
}