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

$(document).ready(function () {
    function updateWeather() {
        $.ajax({
            url: 'http://qlhs.com/admin/get-weather',
            method: 'GET',
            success: function (response) {
                if (response.error) {
                    console.error(response.error);
                    return;
                }

                var data = response.data;
                $('#weather-location').html(data.location.name);
                $('#weather-temp_c').html(data.current.temp_c + '°C');
                var weatherImage = data.current.condition.icon;
                $('#weather-image').attr('src', weatherImage);

                var localDate = data.location.localtime.split(' ')[0];
                $('#weather-date').html(localDate);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    setInterval(updateWeather, 5000);
    updateWeather();
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

$('.logo_name').click(function (event) {
    event.preventDefault();
    localStorage.removeItem('activeButton');
    window.location.href = "http://qlhs.com/admin/dashboard";
});






