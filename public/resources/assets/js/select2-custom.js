"use strict";
setTimeout(function () {
    (function ($) {
        "use strict";
        // Single Search Select
        $('.js-example-basic-single').select2();

        $('.status-change-select').select2();
        // $('.status-change-select').select2({
        //     minimumResultsForSearch: -1 // Set to -1 to disable search
        // });
        $('.select-product-multiple').select2({
            multiple: true,// Add this option to enable multi-select
            placeholder: "Search product name.."
        });

        $(".js-example-placeholder-multiple").select2({
            placeholder: "Select Your Name"
        });

    })(jQuery);
}
    , 350);