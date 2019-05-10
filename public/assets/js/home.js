$(function () {
    $('#bidAmount').maskMoney({prefix: '$ ', allowNegative: true, thousands: ',', decimal: '.', affixesStay: false});
});

function showPlaceBidModal(id) {
    showModal('placeBidModal');
    $('#bidAmount').focus();
    $.ajax({
        url: "/auction/" + id,
        type: "GET",
        async: false,
        success: function (response) {
            if (response) {
                $("#placeBidModal").find('#auctionId').val(response.id);
                $("#placeBidModal").find('.current-bid').html('$' + response.starting_bid);
                $("#placeBidModal").find('.modal-title').html('Bid > ' + response.title);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert.danger(_alert_container, "Unexpected error occurred when fetching Auction Info : Error Code - " +
                jqXHR.status);
        }
    });
    $("#placeBidModal").find('.auction-countdown').html('00h 00h 00m 00s');
    $("#placeBidModal").find('.auction-countdown').removeClass(function (index, className) {
        return (className.match(/\bauction-countdown-\S+/g) || []).join(' ');
    });
    $("#placeBidModal").find('.auction-countdown').addClass('auction-countdown-' + id);
    $("#placeBidModal").find('.current-bid').addClass('current-bid-' + id);
}

function placeBid() {
    var amount = $("#bidAmount").val();
    var auctionId = $("#auctionId").val();
    $.ajax({
        url: "/auction/bid",
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            auctionId: auctionId,
            amount: amount
        },
        success: function (response) {
            if (response.hasErrors) {
                alert.danger(_alert_container, response.errorList.join());
            } else {
                alert.success(_alert_container, 'Your bid of <b>' + amount + '</b> placed successfully');
                $("#bidAmount").val('0.00');
                $(".current-bid-" + auctionId).html('$' + response.result);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert.danger(_alert_container, "Unexpected error occurred when place bid : Error Code - " +
                jqXHR.status);
        }
    });
}

var slideIndex = 1;

function loopSlides() {
    showSlides(slideIndex);
    slideIndex++;
    setTimeout(loopSlides, 3000);
}

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("product-slide");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].classList.toggle("active");
}