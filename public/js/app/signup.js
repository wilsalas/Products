$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*----------------------------------------------------------------------------------------------------- */
    $('#frm_signup').submit(e => {
        e.preventDefault();
        fetch('products/signup', {
            credentials: 'same-origin',
            method: 'post',
            mode: 'cors',
            body: new FormData(document.getElementById('frm_signup'))
        })
            .then(res => {
                if (res.ok) {
                    return res.json();
                }
                else {
                    throw new Error('Bad http stuff')
                }
            })
            .then(data => {
                switch (data[0]) {
                    case "errors":
                        ClassGeneral.AlertMessage('Warning', data[1], 'warning')
                        break;
                    case "success":
                        ClassGeneral.AlertMessage('Success', data[1], 'success')
                        $('#frm_signup')[0].reset()
                        break;
                }
            })
            .catch(err => console.error("Error: " + err.message))
    })
})