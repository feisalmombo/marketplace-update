        $("#seeAnotherField").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldDiv').show();
        $('#otherField').attr('required', '');
        $('#otherField').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldDiv').hide();
        $('#otherField').removeAttr('required');
        $('#otherField').removeAttr('data-error');
    }
    });
    $("#seeAnotherField").trigger("change");

    $("#status").change(function() {
    if ($(this).val() == "yes") {
        $('#otherFieldGroupDiv').show();
        $('#bank_name').attr('required', '');
        $('#bank_name').attr('data-error', 'This field is required.');
        $('#otherField2').attr('required', '');
        $('#otherField2').attr('data-error', 'This field is required.');
    } else {
        $('#otherFieldGroupDiv').hide();
        $('#bank_name').removeAttr('required');
        $('#bank_name').removeAttr('data-error');
        $('#otherField2').removeAttr('required');
        $('#otherField2').removeAttr('data-error');
    }
    });
    $("#status").trigger("change");
