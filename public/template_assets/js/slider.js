if ($.fn.slick !== undefined) {
    // Biasa
    if ($(".top-projects.standard").length > 0) {
        $(".top-projects.standard").slick({
            slidesToShow: 3,
            speed: 300,
            slidesToScroll: 1,
            focusOnSelect: true,
            autoplay: false,
            arrows: true,
            appendArrows: $("#top-standard-slick-arrow"),
            responsive: [
                {
                    breakpoint: 1199,
                    settings: { arrows: false, slidesToShow: 3 },
                },
                {
                    breakpoint: 991,
                    settings: { arrows: false, slidesToShow: 2 },
                },
                {
                    breakpoint: 550,
                    settings: { arrows: false, autoplay: true, slidesToShow: 1 },
                },
            ],
        });
    }

    // Payment Status
    if ($(".top-projects.payment").length > 0) {
        $(".top-projects.payment").slick({
            slidesToShow: 3,
            speed: 300,
            slidesToScroll: 1,
            focusOnSelect: true,
            autoplay: false,
            arrows: true,
            appendArrows: $("#top-payment-slick-arrow"),
            responsive: [
                {
                    breakpoint: 1199,
                    settings: { arrows: false, slidesToShow: 3 },
                },
                {
                    breakpoint: 991,
                    settings: { arrows: false, slidesToShow: 2 },
                },
                {
                    breakpoint: 550,
                    settings: { arrows: false, autoplay: true, slidesToShow: 1 },
                },
            ],
        });
    }

    // Order Status
    if ($(".top-projects.order").length > 0) {
        $(".top-projects.order").slick({
            slidesToShow: 3,
            speed: 300,
            slidesToScroll: 1,
            focusOnSelect: true,
            autoplay: false,
            arrows: true,
            appendArrows: $("#top-order-slick-arrow"),
            responsive: [
                {
                    breakpoint: 1199,
                    settings: { arrows: false, slidesToShow: 3 },
                },
                {
                    breakpoint: 991,
                    settings: { arrows: false, slidesToShow: 2 },
                },
                {
                    breakpoint: 550,
                    settings: { arrows: false, autoplay: true, slidesToShow: 1 },
                },
            ],
        });
    }
}
