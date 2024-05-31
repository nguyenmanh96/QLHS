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

$('.logo_name').click(function (event) {
    event.preventDefault();
    localStorage.removeItem('activeButton');
    window.location.href = "http://qlhs.com/admin/dashboard";
});
