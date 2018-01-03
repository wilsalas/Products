class ClassGeneral {
    static AlertMessage(title, text, type) {
        swal({
            title: title,
            html: text,
            type: type,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        })
    }

}