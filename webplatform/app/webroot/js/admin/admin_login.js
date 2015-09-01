$('#userRegisterIds').submit(function () {

        var flag = '0';
        var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = $('#registeremail');
        var UserGroupId = $('#UserGroupId');
        var UserCountry = $('#UserCountry');
        var UserState = $('#UserState');
        var UserCompanyId = $("#UserCompanyId");
        var UserLocation = $("#UserLocation");
        var UserUserCompanyId = $("#UserUserCompanyId");
        var UserUserTypeId = $("#UserUserTypeId");
        $('.errorset').each(function () {
            if (this.value == '') {
                $(this).removeClass('valid');
                $(this).addClass('invalid');
                flag = '1';
            } else {
                $(this).removeClass('invalid');
                $(this).addClass('valid');
            }
        }); 
       
        if (!regex.test(email.val())) {
            email.removeClass('valid');
            email.addClass('invalid');
            flag = '1';
        } else {
            email.removeClass('invalid');
            email.addClass('valid');
        }
        if (flag == 1) {
            $('#flashMessageajax').html('Please enter valid information in red marked box').addClass('alert-danger');
            return false;
        }
        $('#flashMessageajax').html('').hide();
        return true;
    });