// price range 
$(function() {
    var $range = $(".js-range-slider"),
        $inputFrom = $(".js-input-from"),
        $inputTo = $(".js-input-to"),
        instance,
        min = 0,
        max = 40000,
        from = 0,
        to = 1000;

    // Get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const priceParam = urlParams.get("price");

    if (priceParam) {
        // Split the priceParam by ";" to get the min and max values
        const [minPrice, maxPrice] = priceParam.split(";");

        // Set the default range values for the slider
        from = parseInt(minPrice);
        to = parseInt(maxPrice);
    }

    $range.ionRangeSlider({
        type: "double",
        min: min,
        max: max,
        from: from,
        to: to,
        prefix: '$. ',
        onStart: updateInputs,
        onChange: updateInputs,
        step: 500,
        prettify_enabled: true,
        prettify_separator: ".",
        values_separator: " - ",
        force_edges: true
    });

    instance = $range.data("ionRangeSlider");

    function updateInputs(data) {
        from = data.from;
        to = data.to;

        $inputFrom.prop("value", from);
        $inputTo.prop("value", to);
    }

    $inputFrom.on("input", function() {
        var val = $(this).prop("value");

        // validate
        if (val < min) {
            val = min;
        } else if (val > to) {
            val = to;
        }

        instance.update({
            from: val
        });
    });

    $inputTo.on("input", function() {
        var val = $(this).prop("value");

        // validate
        if (val < from) {
            val = from;
        } else if (val > max) {
            val = max;
        }

        instance.update({
            to: val
        });
    });
});
// end 

// select only one rating 
const ratingCheckboxes = document.querySelectorAll('.rating-checkbox');
ratingCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        ratingCheckboxes.forEach(cb => {
            if (cb !== checkbox) {
                cb.checked = false;
            }
        });
    });
});
// end 