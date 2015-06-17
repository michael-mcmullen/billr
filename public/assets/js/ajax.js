function switchElement(elementToHide, elementToShow) {
    $(elementToHide).hide();
    $("#" + elementToShow).fadeIn('slow');
    $("#" + elementToShow).css({display: 'inline'});

}