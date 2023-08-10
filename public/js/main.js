let _baseURL = window.location.origin + '/admin/';
let _imgLoader = "<img src='" + _baseURL + "lib/images/loader.gif'>";

$(document).ready(function () {
    $(".parsley-form").parsley();
    $(".logIn").click(function () {
        let username = $(".username").val();
        let password = $(".password").val();
        let dataForm = $(".loginForm").serialize();
        if (username !== '' && password !== '') {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: _baseURL + "auth",
                data: dataForm,
                dataType: "json",
                success: function (response) {
                    var btn = $(".logIn");
                    if (response.meta.status == 'success') {
                        btn.html('Checking.. <i class="fa fa-spinner fa-spin"></i>');
                        btn.attr('disabled', 'disabled');
                        setTimeout(function () {
                            btn.removeClass('btn btn-primary ');
                            btn.addClass('btn btn-success');
                            btn.html("User ada <i class='fa fa-check'></i>");
                            $(".loginForm")[0].reset();
                        }, 1000);
                        setTimeout(function () {
                            btn.removeClass('btn btn-success');
                            btn.addClass('btn btn-primary');
                            btn.html("Mohon Tunggu.. <i class='fa fa-spinner fa-spin'></i>");
                        }, 2000);
                        setTimeout("window.location.href='" + _baseURL + "dashboard'", 3000);
                    } else {
                        btn.html('Checking.. <i class="fa  fa-spinner fa-spin"></i>');
                        btn.attr('disabled', 'disabled');
                        setTimeout(function () {
                            btn.removeClass('btn btn-primary ');
                            btn.addClass('btn btn-warning');
                            btn.html('User tidak ada <i class="fe-info"></i>');
                            $(".username").addClass('is-invalid');
                            $(".password").addClass('is-invalid');
                            $(".invalid-login").html(response.meta.message);
                            $(".loginForm")[0].reset();
                        }, 1000);
                        setTimeout(function () {
                            btn.removeClass('btn btn-warning');
                            btn.addClass('btn btn-primary');
                            btn.removeAttr('disabled', 'disabled');
                            btn.html('Masuk');
                        }, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Status code: ' + jqXHR.status + ' ' + errorThrown);
                }
            });
        }
    });
    
});
