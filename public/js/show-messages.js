document.addEventListener('DOMContentLoaded', function () {
    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        errorAlert.classList.add('show');
        setTimeout(function () {
            errorAlert.classList.remove('show');
        }, 2000);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var successAlert = document.getElementById('successAlert');
    if (successAlert) {
        successAlert.classList.add('show');
        setTimeout(function () {
            successAlert.classList.remove('show');
        }, 2000);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var validateAlert = document.getElementById('validateAlert');
    if (validateAlert) {
        validateAlert.classList.add('show');
        setTimeout(function () {
            validateAlert.classList.remove('show');
        }, 2000);
    }
});
