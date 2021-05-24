$(function () {
    $('.next_steps').on('click', function () {
        if ($(this).val() == 'step_1') {
            saveUserData();
        }

        if ($(this).val() == 'step_2') {
            saveUserAddressData();
        }

        if ($(this).val() == 'step_3') {
            saveUserPhoneData();
        }
    });

    $('.previous_steps').on('click', function () {
        if ($(this).val() == 'step_1') {
            $('#step_1').attr('hidden', false);
            $('#step_2').attr('hidden', true);
            $('#step_3').attr('hidden', true);
        }

        if ($(this).val() == 'step_2') {
            $('#step_1').attr('hidden', true);
            $('#step_2').attr('hidden', false);
            $('#step_3').attr('hidden', true);
        }

        if ($(this).val() == 'step_3') {
            $('#step_1').attr('hidden', true);
            $('#step_2').attr('hidden', true);
            $('#step_3').attr('hidden', false);
        }
    });


    function validateUserData () {
        let validate = true;

        if (!$('#user_name').val()) {
            $('#user_name').addClass('is-invalid');
            $('#invalid_user_name').text('O nome do usuário é obrigatório.');
            validate = false;
        }

        if (!$('#user_birthday').val()) {
            $('#user_birthday').addClass('is-invalid');
            $('#invalid_user_birthday').text('A data de nascimento do usuário é obrigatório.');
            validate = false;
        }

        return validate;
    }

    function validateUserAddressData () {
        let validate = true;
        
        if (!$('#address_state').val()) {
            $('#address_state').addClass('is-invalid');
            $('#invalid_address_state').text('O estado do endereço é obrigatório.');
            validate = false;
        }

        if (!$('#address_city').val()) {
            $('#address_city').addClass('is-invalid');
            $('#invalid_address_city').text('A cidade identificador do endereço é obrigatório.');
            validate = false;
        }

        if (!$('#address_street').val()) {
            $('#address_street').addClass('is-invalid');
            $('#invalid_address_street').text('A rua do endereço é obrigatório.');
            validate = false;
        }

        if (!$('#address_number').val()) {
            $('#address_number').addClass('is-invalid');
            $('#invalid_address_number').text('O número do endereço é obrigatório.');
            validate = false;
        }

        if (!$('#address_zip_code').val()) {
            $('#address_zip_code').addClass('is-invalid');
            $('#invalid_address_zip_code').text('O CEP do endereço é obrigatório.');
            validate = false;
        }

        return validate;
    }

    function validateUserPhoneData () {
        let validate = true;
        
        if (!$('#phone_mobile').val()) {
            $('#phone_mobile').addClass('is-invalid');
            $('#invalid_phone_mobile').text('O celular do contato é obrigatório.');
            validate = false;
        }

        if (!$('#phone_phone').val()) {
            $('#phone_phone').addClass('is-invalid');
            $('#invalid_phone_phone').text('O telefone fixo do contato é obrigatório.');
            validate = false;
        }

        return validate;
    }

    function saveUserData () {
        if (validateUserData()) {
            var user_data = {
                name: $('#user_name').val(),
                birthday: $('#user_birthday').val()
            };

            $.ajax({
                url : window.location.protocol + '//' + window.location.host + '/api/user/' + $('#user').val(),
                type: "POST",
                data : user_data,
                success: (data) =>
                {
                    $('#user').val(data.id);
                    $('#step_1').attr('hidden', true);
                    $('#step_2').attr('hidden', false);
                    $('#step_3').attr('hidden', true);
                },
                error: (data) =>
                {
                    if (data.status == 422) {
                        setErrorsInput('user_', data.responseJSON);
                    }
                    
                    if (data.status != 422) {
                        Swal.fire(
                            'Erro!',
                            data.responseText,
                            'error'
                        );
                    }
                }
            });
        }
    }

    function saveUserAddressData () {
        if (validateUserAddressData()) {
            var user_address_data = {
                state: $('#address_state').val(),
                city: $('#address_city').val(),
                street: $('#address_street').val(),
                number: $('#address_number').val(),
                zip_code: $('#address_zip_code').val()
            };

            $.ajax({
                url : window.location.protocol + '//' + window.location.host + '/api/address/' + $('#user').val(),
                type: "POST",
                data : user_address_data,
                success: () =>
                {
                    $('#step_1').attr('hidden', true);
                    $('#step_2').attr('hidden', true);
                    $('#step_3').attr('hidden', false);
                },
                error: (data) =>
                {
                    if (data.status == 422) {
                        setErrorsInput('address_', data.responseJSON);
                    }
                    
                    if (data.status != 422) {
                        Swal.fire(
                            'Erro!',
                            data.responseText,
                            'error'
                        );
                    }
                }
            });
        }
    }

    function saveUserPhoneData () {
        if (validateUserPhoneData()) {
            var user_phone_data = {
                mobile: $('#phone_mobile').val(),
                phone: $('#phone_phone').val()
            };

            $.ajax({
                url : window.location.protocol + '//' + window.location.host + '/api/phone/' + $('#user').val(),
                type: "POST",
                data : user_phone_data,
                success: () =>
                {
                    Swal.fire({
                        title: 'Sucesso!',
                        icon: 'success',
                        text: 'O usuário foi cadastrado!',
                        showCloseButton: true,
                        confirmButtonText: 'confirmar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(location).attr('href', window.location.protocol + '//' + window.location.host + '/user');
                        }
                    });
                },
                error: (data) =>
                {
                    if (data.status == 422) {
                        setErrorsInput('phone_', data.responseJSON);
                    }
                    
                    if (data.status != 422) {
                        Swal.fire(
                            'Erro!',
                            data.responseText,
                            'error'
                        );
                    }
                }
            });
        }
    }

    function setErrorsInput(step, data) {
        for (const key in data.errors) {
            $('#' + step + key).addClass('is-invalid');
            $('#invalid_' + step + key).text(data.errors[key][0])
        }
    }

    $('#user_name').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }

        if (!$('#user').val() && $(this).val() != '') {
            $.ajax({
                url : window.location.protocol + '//' + window.location.host + '/api/user/details',
                type: "GET",
                data: { name: $(this).val() },
                success: (data) =>
                {
                    if (data) {
                        $('#user').val(data.user.id);
                        $('#user_name').val(data.user.name);
                        $('#user_birthday').val(data.user.birthday);
                        $('#address_state').val(data.address.state);
                        $('#address_city').val(data.address.city);
                        $('#address_street').val(data.address.street);
                        $('#address_number').val(data.address.number);
                        $('#address_zip_code').val(data.address.zip_code);
                        $('#phone_mobile').val(data.phone_mobile.number);
                        $('#phone_phone').val(data.phone_phone.number);
                    }
                },
                error: (data) =>
                {
                    if (data.status != 422) {
                        Swal.fire(
                            'Erro!',
                            data.responseText,
                            'error'
                        );
                    }
                }
            });
        }
    });

    $('#user_birthday').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#address_state').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#address_city').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#address_street').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#address_number').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#address_zip_code').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#phone_mobile').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $('#phone_phone').on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != '') {
            $(this).removeClass('is-invalid');
        }
    });
});
