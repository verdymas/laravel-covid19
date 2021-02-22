$(document).ready(function () {
    setTimeout(hideLoader, 0.5 * 1000);
});

setTimeout(hideLoader, 5000);

// Restricts input for the set of matched elements to the given inputFilter function.
(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

function hideLoader() {
    $('#preloader').hide();
}

function showLoader() {
    $('#preloader').show();
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

const ToastLoader = Swal.mixin({
    toast: true,
    title: 'Checking...',
    position: 'top-end',
    onBeforeOpen: () => {
        Swal.showLoading()
    },
    showConfirmButton: false,
    allowEscapeKey: false
});

function swalLoader(id = 'body') {
    Swal.fire({
        title: 'Checking...',
        text: 'Please wait',
        imageUrl: "/adminlte/dist/img/preloader.svg",
        customClass: 'swal-wide-sm',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        target: document.getElementById(id)
    });
}

function swalFire(icon = 'icon', title = 'title', text = 'text', customClass = 'swal-wide', target = 'body') {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        customClass: customClass,
        showConfirmButton: false,
        timer: 1000,
        target: document.getElementById(target)
    });
}
