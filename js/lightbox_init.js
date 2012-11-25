var settings = {
    // Configuration related to overlay
    overlayBgColor: 		'#000',		// (string) Background color to overlay; inform a hexadecimal value like: #RRGGBB. Where RR, GG, and BB are the hexadecimal values for the red, green, and blue values of the color.
    overlayOpacity:			0.8,		// (integer) Opacity value to overlay; inform: 0.X. Where X are number from 0 to 9
    // Configuration related to navigation
    fixedNavigation:		true,		// (boolean) Boolean that informs if the navigation (next and prev button) will be fixed or not in the interface.
    // Configuration related to images
    imageLoading:			'/js/jquery.lightbox/images/lightbox-ico-loading.gif',		// (string) Path and the name of the loading icon
    imageBtnPrev:			'/js/jquery.lightbox/images/lightbox-btn-prev.gif',			// (string) Path and the name of the prev button image
    imageBtnNext:			'/js/jquery.lightbox/images/lightbox-btn-next.gif',			// (string) Path and the name of the next button image
    imageBtnClose:			'/js/jquery.lightbox/images/lightbox-btn-close.gif',		// (string) Path and the name of the close btn
    imageBlank:				'/js/jquery.lightbox/images/lightbox-blank.gif',			// (string) Path and the name of a blank image (one pixel)
    // Configuration related to container image box
    containerBorderSize:	10,			// (integer) If you adjust the padding in the CSS for the container, #lightbox-container-image-box, you will need to update this value
    containerResizeSpeed:	400,		// (integer) Specify the resize duration of container image. These number are miliseconds. 400 is default.
    // Configuration related to texts in caption. For example: Image 2 of 8. You can alter either "Image" and "of" texts.
    txtImage:				'',	// (string) Specify text "Image"
    txtOf:					'',		// (string) Specify text "of"
    // Configuration related to keyboard navigation
    keyToClose:				'X',		// (string) (c = close) Letter to close the jQuery lightBox interface. Beyond this letter, the letter X and the SCAPE key is used to.
    keyToPrev:				'p',		// (string) (p = previous) Letter to show the previous image
    keyToNext:				'n'		// (string) (n = next) Letter to show the next image.
};
$(function() {

    $('.ad-image-wrapper').click(function(e){
        if ($(e.target).is('img, span.zoom')) {
            var img = $(this).find('.ad-image img');
            img.attr('href', img.attr('src'));
            img.lightBox(settings);
            img.click();
            e.stopPropagation();
        }
        return false;
    });
});