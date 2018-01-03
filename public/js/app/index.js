$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*----------------------------------------------------------------------------------------------------- */
    $('#frm_login').submit(e => {
        e.preventDefault();
        fetch('products/login', {
            credentials: 'same-origin',
            method: 'post',
            mode: 'cors',
            body: new FormData(document.getElementById('frm_login'))
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
                    case "sucess":
                        location.href = data[1];
                        break;
                    default:
                        break;
                }
            })
            .catch(err => console.error("Error: " + err.message))
    })
})