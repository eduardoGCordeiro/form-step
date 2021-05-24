$(function () {
    $('.delete_user').on('click', function () {
        Swal.fire({
            title: 'Atenção!',
            icon: 'warning',
            text: 'Você realmente deseja deletar esse usuário?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText: 'cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $(location).attr('href', window.location.protocol + '//' + window.location.host + '/user/delete/' + $(this).data('value'));
            }
        });
    });
});
