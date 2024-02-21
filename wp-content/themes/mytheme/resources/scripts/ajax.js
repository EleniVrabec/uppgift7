jQuery(document).ready(function($) {
    // Add event listener to all radio inputs with class 'input-radio' inside '.wc_payment_methods'
    $('.wc_payment_methods .input-radio').change(function() {
        // Reset color of all labels to gray
        $('.wc_payment_methods label').css('color', 'gray');

        // Check which radio input is selected
        var selectedInput = $(this);
        if (selectedInput.prop('checked')) {
            // Change color of label next to selected input to black
            selectedInput.closest('li').find('label').css('color', 'black');
        }
    });
});