class ClassGeneral {
    static AlertMessage(title, text, type, filter) {
        swal({
            title: title,
            html: text,
            type: type,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        }).then((result) => {
            if (typeof filter !== 'undefined') {
                location.href = '/';
            }
        })
    }

}