document.addEventListener('DOMContentLoaded', function () {
    var successAlert = document.getElementById('successAlert');
    if (successAlert) {
        successAlert.classList.add('show');
        setTimeout(function () {
            successAlert.classList.remove('show');
        }, 2000);
    }
});
