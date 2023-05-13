var hamburgerButton = $('#humburger');
var ranProfileImage = $('#ranProfileImage');
var searchBar = $('#searchBar');
var logo = $('#logoExpanded');

hamburgerButton.click(function () {
    if (hamburgerButton.hasClass("collapsed")) {
        logo.fadeOut(function () {
            ranProfileImage.fadeIn();
            searchBar.fadeIn();
        });
    } else {
        ranProfileImage.fadeOut();
        searchBar.fadeOut(function () {
            logo.fadeIn();
        });
    }
});
    