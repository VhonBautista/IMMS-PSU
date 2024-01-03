var isSmallScreen = window.innerWidth <= 764;

var buttonElement = document.getElementById('dropdownNotificationButton');

if (isSmallScreen) {
    buttonElement.setAttribute('data-dropdown-offset-distance', '20');
}