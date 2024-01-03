if (typeof(Storage) !== "undefined") {
    var lastScrollPosition = sessionStorage.getItem('lastScrollPosition');

    if (lastScrollPosition !== null) {
        window.scrollTo(0, lastScrollPosition);
    }

    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('lastScrollPosition', window.scrollY);
    });
}