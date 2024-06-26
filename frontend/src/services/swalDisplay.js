export const showSwal = function (self, type, title, body = null, timer = null) {
    let icon = null;

    switch (type) {
        case 1:
            icon = 'error';
            break;
        case 2:
            icon = 'info';
            break;
        case 3:
            icon = 'success';
            break;
        case 4:
            icon = 'question';
            break;
    }

    return self.$swal.fire({
        icon: icon,
        title: title ?? 'Oops...',
        text: body,
        timer: timer,
        timerProgressBar: timer != null,
    });
}