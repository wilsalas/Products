$(document).ready(() => {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*----------------------------------------------------------------------------------------------------- */
    let type = "", id_product = 0;

    GetListProducts()
    function GetListProducts() {
        $.get('products/list_products', data => {
            let products = [];
            data.forEach(elem => {
                products += `
                <div class="col-sm-4 card_list">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">${elem.title}</h5>
                      <p class="card-text">${elem.description}</p>
                      <button type="button" class="btn btn-outline-warning update" value="${elem.id}">Update</button>
                      <button type="button" class="btn btn-outline-danger delete" value="${elem.id}">Delete</button>
                    </div>
                  </div>
                </div>`;
            });
            $('#list_products').html(products)
        })
    }


    $('#new_product').click(() => {
        $('#exampleModal').modal()
        type = "insert";
        $('#frm_insert_update')[0].reset()
    })

    $(document).on('click', '.update', function () {
        $('#exampleModal').modal()
        type = "update";
        $("input[name='title']").val($(this).parent().find('.card-title').text())
        $("textarea[name='description']").val($(this).parent().find('.card-text').text())
        id_product = $(this).val();
    })

    $(document).on('click', '.delete', function () {
        id_product = $(this).val();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.post('products/deleteproduct', { id: id_product }, data => {
                    switch (data[0]) {
                        case "errors":
                            ClassGeneral.AlertMessage('Warning', data[1], 'warning')
                            break;
                        case "success":
                            ClassGeneral.AlertMessage('Success', data[1], 'success')
                            $('#frm_insert_update')[0].reset()
                            $('#exampleModal').modal('hide')
                            GetListProducts()
                            break;
                    }
                })
            }
        })

    })

    $('#frm_insert_update').submit(e => {
        e.preventDefault();
        let data = "", formData = new FormData(document.getElementById('frm_insert_update'));
        if (type == "insert") {
            path = 'products/newproduct';
            data = formData;
        } else if (type == "update") {
            path = 'products/updateproduct';
            formData.append('id', id_product);
            data = formData;
        }
        fetch(path, {
            credentials: 'same-origin',
            method: 'post',
            mode: 'cors',
            body: data
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
                        $('#frm_insert_update')[0].reset()
                        $('#exampleModal').modal('hide')
                        GetListProducts()
                        break;
                }
            })
            .catch(err => console.error("Error: " + err.message))
    })

})