(function($) {
    "use strict";

    $(document).ready(function() {

        // Check Click1 :)
        $(".checkclick1").on("change", function() {
            if (this.checked) {
                $(this).parent().parent().parent().parent().next().removeClass('showbox');
            } else {
                $(this).parent().parent().parent().parent().next().addClass('showbox');
            }
        });
        // Check Click1 Ends :)

    });
    
    // Size Section

    $("#size-btn").on('click', function() {

        $("#size-section").append('' +
            '<div class="size-area">' +
            '<span class="remove size-remove float-right"><i class="fas fa-times"></i></span>' +
            '<div class="mb-3">' +
            // '<div class="row">' +
            // '<div class="col-md-6">' +
            // '<label>' +
            // 'Size Name :' + '<span>(eg. S,M,L,XL,XXL,3XL,4XL)</span>' +
            // '</label>' +
            '<input type="text" name="size_name[]" id="size_name" class="form-control" placeholder="Size Name">' +
            // '</div>' +
            // '<div class="col-md-6">' +
            // '<label>' +
            // 'Size Qty :' +'<span>(Number of quantity of this size)</span>' +
            // '</label>' +
            // '<input type="number" name="size_qty[]" id="size_qty" class="form-control" placeholder="Size Qty" min="1">' +
            // '</div>' +
            // '</div>' +
            '</div>' +
            '</div>' +
            '');

    });

    $(document).on('click', '.size-remove', function() {

        $(this.parentNode).remove();
        if (isEmpty($('#size-section'))) {

            $("#size-section").append('' +
                '<div class="size-area">' +
                '<span class="remove size-remove float-right"><i class="fas fa-times"></i></span>' +
                '<div class="mb-3">' +
                // '<div class="row">' +
                // '<div class="col-md-6">' +
                // '<label>' +
                // 'Size Name :' + '<span>(eg. S,M,L,XL,XXL,3XL,4XL)</span>' +
                // '</label>' +
                '<input type="text" name="size_name[]" id="size_name" class="form-control" placeholder="Size Name">' +
                // '</div>' +
                // '<div class="col-md-6">' +
                // '<label>' +
                // 'Size Qty :' +'<span>(Number of quantity of this size)</span>' +
                // '</label>' +
                // '<input type="number" name="size_qty[]" id="size_qty" class="form-control" placeholder="Size Qty" min="1">' +
                // '</div>' +
                // '</div>' +
                '</div>' +
                '</div>' +
                '');
        }

    });

    // $("#size-check").prop("checked", false);
    // $(document).ready(function() {
    //     // body...

    // $('#size-check').click(function(){
    //         if($(this).prop("checked") == true){
    //             $("#size-check").prop("checked", true);
    //             $("#size-display").show();
    //         }else{
    //             $("#size-display").hide();

    //         }

    //     });
    //         $("#size-display").hide();

    // });
    // $("#size-display").hide();

    $("#size-check").change(function() {
    if(this.checked) {
        $("#size-display").show();
        // $("#stckprod").hide();
    }
    else
    {
        $("#size-display").hide();
        // $("#stckprod").show();

    }
});


    // Size Section Ends


    // Color Section

    $("#color-btn").on('click', function() {

        $("#color-section").append('' +
            '<div class="color-area">' +
            '<span class="remove color-remove float-right"><i class="fas fa-times"></i></span>' +
            '<div class="mb-3">' +
            '<div class="form-group colorpicker-component cp">' +
            '<label>' +
            'Select Color :' +'<span>(Choose your color)</span>' +
            '</label>' +
            '<select name="colors[]" id="colors" class="form-control select2bs4" style="width: 100%;">' +
            '<option value="water-bottle">Water Bottle</option>' +
            '<option value="mobile-phones">Mobile Phones</option>' +
            '<option value="machine">Machine</option>' +
            '</select>' +
            // '<input type="text" name="colors[]" id="colors" class="form-control"/>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '');
        // $('.cp').colorpicker();
    });




    $(document).on('click', '.color-remove', function() {

        $(this.parentNode).remove();
        if (isEmpty($('#color-section'))) {

            $("#color-section").append('' +
                '<div class="color-area">' +
                '<span class="remove color-remove"><i class="fas fa-times"></i></span>' +
                '<div class="form-group colorpicker-component cp">' +
                '<input type="text" name="colors[]" id="colors" class="form-control cp"/>' +
                '</div>' +

                '</div>' +
                '');
            $('.cp').colorpicker();
        }

    });

    // $("#color-display").hide();

    $("#color-check").change(function() {
        if(this.checked) {
            $("#color-display").show();
            // $("#stckprod").hide();
        }
        else
        {
            $("#color-display").hide();
            // $("#stckprod").show();

        }
    });

    // Color Section Ends


    // SALE SECTION START

    // $("#sale-display").hide();
    $("#sale-check").change(function() {
        // alert("hello");
        if(this.checked) {
            $("#sale-display").show();
        }
        else
        {
            $("#sale-display").hide();
        }
    });

})(jQuery);