let _baseURL = window.location.origin + '/admin/';
let _baseUrlAPI = window.location.origin + '/api/';
// let token   = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    $(".parsley-form").parsley();
    $('.select2').select2()
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    let flashData  = $('.flash-data').data('flash');
    let flashTitle = $('.flash-data').data('title');
    let flashAlert = $('.flash-data').data('alert');

     let errorData = $('.error-data').data('flash');
     let errorTitle = $('.error-data').data('title');
     let errorAlert = $('.error-data').data('alert');

    if (flashData) {
        Swal.fire({
            title: flashTitle,
            html: flashData,
            type: flashAlert,
            confirmButtonClass: "btn btn-confirm mt-2"
        });
    }
    if (errorData) {
        Swal.fire({
            title: errorTitle,
            html: errorData,
            type: errorAlert,
            confirmButtonClass: "btn btn-confirm mt-2"
        });
    }
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        let form  = e.currentTarget.form;
        let debug = $(this).data('debug');
        let data  = $(this).data('id');
        var forms = document.getElementById(data);
        Swal.fire({
            title: "Yakin untuk menghapus?",
            text: "Data ini akan di hapus! : "+debug+"",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Tidak, batal!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ml-2 mt-2",
            buttonsStyling: !1,
        }).then(function (t) {
            t.value ? forms.submit() : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                title: "Cancelled",
                text: "Data anda tidak jadi di hapus :)",
                type: "error",
                confirmButtonClass: "btn btn-confirm mt-2"
            })
        })
    });
    
});


var _0x40ed=['Zm9udC1zaXplOnNtYWxs','Y29sb3I6IzRFOUREOTsgZm9udC1zaXplOmxhcmdl','bG9n','JWNSZXpreSBQLiBCdWRpaGFydG9ubwolY1dlYiBEZXZlbG9wZXIgYW5kIERlc2lnbmVyIAotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpGb2xsb3cgbWUgb24gSW5zdGFncmFtICVjQHJlemt5X3JlcmUK','Zm9udC1zaXplOngtbGFyZ2U='];(function(_0x3562b5,_0x22dabc){var _0x54d52d=function(_0x27bd3d){while(--_0x27bd3d){_0x3562b5['push'](_0x3562b5['shift']());}};_0x54d52d(++_0x22dabc);}(_0x40ed,0x89));var _0x3b1f=function(_0x97f8d1,_0x466712){_0x97f8d1=_0x97f8d1-0x0;var _0x5c23e8=_0x40ed[_0x97f8d1];if(_0x3b1f['xOaDtB']===undefined){(function(){var _0x3d3919=function(){var _0x35ed55;try{_0x35ed55=Function('return\x20(function()\x20'+'{}.constructor(\x22return\x20this\x22)(\x20)'+');')();}catch(_0x462ceb){_0x35ed55=window;}return _0x35ed55;};var _0x210ad2=_0x3d3919();var _0x26a316='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';_0x210ad2['atob']||(_0x210ad2['atob']=function(_0x5d772b){var _0x50c6ec=String(_0x5d772b)['replace'](/=+$/,'');for(var _0x59e582=0x0,_0x28fe24,_0x3a3d32,_0x267ab1=0x0,_0x5c6257='';_0x3a3d32=_0x50c6ec['charAt'](_0x267ab1++);~_0x3a3d32&&(_0x28fe24=_0x59e582%0x4?_0x28fe24*0x40+_0x3a3d32:_0x3a3d32,_0x59e582++%0x4)?_0x5c6257+=String['fromCharCode'](0xff&_0x28fe24>>(-0x2*_0x59e582&0x6)):0x0){_0x3a3d32=_0x26a316['indexOf'](_0x3a3d32);}return _0x5c6257;});}());_0x3b1f['UxHiLf']=function(_0x4bf6ef){var _0x11ae64=atob(_0x4bf6ef);var _0x6c9e31=[];for(var _0x823caf=0x0,_0x45b80f=_0x11ae64['length'];_0x823caf<_0x45b80f;_0x823caf++){_0x6c9e31+='%'+('00'+_0x11ae64['charCodeAt'](_0x823caf)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x6c9e31);};_0x3b1f['GqMTGM']={};_0x3b1f['xOaDtB']=!![];}var _0xa8745b=_0x3b1f['GqMTGM'][_0x97f8d1];if(_0xa8745b===undefined){_0x5c23e8=_0x3b1f['UxHiLf'](_0x5c23e8);_0x3b1f['GqMTGM'][_0x97f8d1]=_0x5c23e8;}else{_0x5c23e8=_0xa8745b;}return _0x5c23e8;};console[_0x3b1f('0x0')](_0x3b1f('0x1'),_0x3b1f('0x2'),_0x3b1f('0x3'),_0x3b1f('0x4'));
