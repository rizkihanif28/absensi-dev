$(document).ready(function () {

    $('#btn-login').on('click', function (e) {
        e.preventDefault()
        login()
            .then(function (res) {
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 2500
                    })
                    // window.location.href = res.link;
                    window.open(res.link, '_self');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        html: res.message,
                    })
                }

            })
            .catch(function (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terdapat Kesalahan Sistem',
                    text: err,
                })
            })
    })

    function login() {
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: $('.login-form').attr('action'),
                method: 'POST',
                dataType: 'json',
                data: $('.login-form').serializeArray()
            }).done(function (res) {
                resolve(res)
            }).fail(function () {
                reject('Gagal login sistem!')
            })
        })
    }

    $(document).on({
        ajaxStart: function () {
            Swal.showLoading()
        },
        ajaxStop: function () {
            Swal.hideLoading()
        }
    });
});