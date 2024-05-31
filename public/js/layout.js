history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};

$('.atom-toolbar-toggle-button').click(function () {
    $('.atom-toolbar').toggleClass('expanded');
    $(this).toggleClass('expanded');
})

const tap = document.querySelector('.profile');
tap.addEventListener('click', function () {
    const toggleMenu = document.querySelector('.menu');
    toggleMenu.classList.toggle('active');
});

function padZero(num) {
    return num < 10 ? "0" + num : num;
}

$(document).ready(function () {
    setInterval(function () {
        let now = new Date()
        let hour = now.getHours();
        let minute = now.getMinutes();
        let second = now.getSeconds();

        $('#time').text(padZero(hour) + ":" + padZero(minute) + ":" + padZero(second));
    }, 1000);
});

$('.atom-toolbar.expanded .btn').click(function () {
    $('atom-toolbar.expanded .btn').removeClass('active');
    $(this).addClass('active');
    localStorage.setItem('activeButton', $(this).attr('href'));
});

$(document).ready(function () {
    var activeButton = localStorage.getItem('activeButton');
    if (activeButton) {
        $('.btn[href="' + activeButton + '"]').addClass('active');
    }
});








