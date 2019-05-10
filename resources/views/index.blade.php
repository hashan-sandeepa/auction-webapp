<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>MyAuction | Home</title>
    <link href="{{ asset('assets/css/nav.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/css/home.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="container">
    <!--include header-->
@include('pages.header')
<!--include navigation bar-->
    @include('pages.nav')

    <div id="content">
        @if (isset($criteria) || isset($categories))
            <div id="criteria-contrainer">
                Search for :
                @if (isset($criteria))
                    <b>{{$criteria}}</b>
                @endif
                @if (isset($categories))
                    @foreach ($categories as $index => $category)
                        <span class="category">{{$category->name}}</span>
                    @endforeach
                @endif
            </div>
        @endif
        <div id="auctions-container">
            @foreach ($auctions as $index => $auction)
                <div class="auction-card">
                    <div class="auction-title"><b>{{ $auction->title }}</b></div>
                    <div class="auction-img-container">
                        <a href="#"><img
                                    src="{{ URL::to('/auction/image/'.str_replace('/', '%', explode('|',$auction->image_paths)[0])) }}"/></a>
                    </div>
                    <div class="auction-body">
                        <div class="auction-categoty"><a href="#">{{$auction->category->name}}</a></div>
                        <div class="current-bid current-bid-{{$auction->id}}">${{$auction->starting_bid}}</div>
                        <div class="auction-countdown auction-countdown-{{$auction->id}}">00h 00h 00m 00s</div>
                        <div class="auction-actions">
                            <center>
                                @if (Auth::check())
                                    <button class="btn btn-orange" onclick="showPlaceBidModal({{ $auction->id }})">Bid
                                    </button>@endif
                                <button class="btn btn-blue" onclick="showDetailsModal({{ $auction->id }})">View
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{--<footer>
        Copyright © 2018 All rights reserved
    </footer>--}}
</div>
@if (Auth::check())
    <!-- Modals -->
    <div id="placeBidModal" class="modal-container">
        <div class="modal modal-sm">
            {{ csrf_field() }}
            <input type="hidden" id="auctionId" name="auctionId">
            <div class="modal-header">
                <a href="javascript:hideModal('placeBidModal')" class="modal-close"></a>
                <div class="modal-title">Bid > Adidas Originals</div>
            </div>
            <div class="modal-content">
                <p class="current-bid">$00.00</p>
                <p class="auction-countdown">00h 00h 00m 00s</p>
                <center><input type="text" name="amount" id="bidAmount" placeholder="Enter Your Bid" required></center>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-orange" onclick="placeBid()">Place</button>
                </center>
            </div>
        </div>
    </div>
@endif
<div id="detailsModal" class="modal-container">
    <div class="modal modal-md">
        <input type="hidden" id="auctionId" name="auctionId">
        <div class="modal-header">
            <a href="javascript:hideModal('detailsModal')" class="modal-close"></a>
            <div class="modal-title">Adidas Originals</div>
        </div>
        <div class="modal-content">
            <div class="product-img-slider">
                <div class="slideshow-container">
                    <div class="product-slide fade">
                        <img src="{{ asset('assets/img/sample-auction-img1.jpg') }}">
                    </div>

                    <div class="product-slide fade">
                        <img src="{{ asset('assets/img/sample-auction-img2.jpg') }}">
                    </div>

                    <div class="product-slide fade">
                        <img src="{{ asset('assets/img/sample-auction-img3.jpg') }}">
                    </div>

                    <div class="product-slide fade">
                        <img src="{{ asset('assets/img/sample-auction-img4.jpg') }}">
                    </div>

                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <div class="slideshow-controllers">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
            </div>
            <div class="product-description">
                <div id="desc">
                    {{--product description will goes here--}}
                </div>
                @if(Auth::check())
                <div id="bid-history-title"><i class="fas fa-history"></i> Bid History</div>
                @endif
                <div id="bid-history">
                    {{--bid history will goes here--}}
                </div>
                <p class="product-desc current-bid">$20</p>
                <p class="product-desc auction-countdown">00h 00h 00m 00s</p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery.maskMoney.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/home.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    function showDetailsModal(id) {
        $.ajax({
            url: "/auction/" + id,
            type: "GET",
            async: false,
            success: function (response) {
                if (response) {
                    $("#detailsModal").find('#auctionId').val(response.id);
                    $("#detailsModal").find('.current-bid').html('$' + response.starting_bid);
                    $("#detailsModal").find('.modal-title').html(response.title);
                    $("#detailsModal").find('#desc').html(response.description);
                    var imgPaths = response.image_paths.split('|');
                    $('#detailsModal').find('.slideshow-container').empty();
                    $('#detailsModal').find('.slideshow-controllers').empty();
                    $.each(imgPaths, function (index, imgPath) {
                        $('#detailsModal').find('.slideshow-container').append('<div class="product-slide fade" ' + (index == 0 ? 'style="display: block;"' : '') + '><img src="/auction/image/' + imgPath.replace(new RegExp('/', 'g'), '%') + '"></div>');
                        $('#detailsModal').find('.slideshow-controllers').append('<span class="dot' + (index == 0 ? ' active' : '') + '" onclick="currentSlide(' + (index + 1) + ')"></span>');
                    });
                    if (imgPaths.length > 1) {
                        $('#detailsModal').find('.slideshow-container').append('<a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a>')
                    } else {
                        $('#detailsModal').find('.slideshow-container .prev').remove();
                        $('#detailsModal').find('.slideshow-container .next').remove();
                    }
                }
                showModal('detailsModal');
                loopSlides();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert.danger(_alert_container, "Unexpected error occurred when fetching Auction Info : Error Code - " +
                    jqXHR.status);
            }
        });
        @if(Auth::check())
        $.ajax({
            url: "/auction/" + id + "/bid/history",
            type: "GET",
            async: false,
            success: function (response) {
                if (response) {
                    var elem = '';
                    console.log(response);
                    if (response && response.length > 0) {
                        $.each(response, function (index, obj) {
                            elem +=
                                '<div class="history">' +
                                '<div class="bidder-name">' + obj.user.first_name + '</div>' +
                                '<div class="bid-amount">' + obj.amount + '</div>' +
                                '<div class="bid-dt">' + obj.created_at + '</div>' +
                                '</div>';

                        });
                    } else {
                        elem = '<div id="msg">< No bids yet ></div>';
                    }
                    $("#detailsModal").find("#bid-history").html(elem);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert.danger(_alert_container, "Unexpected error occurred when fetching Bid History : Error Code - " +
                    jqXHR.status);
            }
        });
        @endif
        $("#detailsModal").find('.auction-countdown').html('00h 00h 00m 00s');
        $("#detailsModal").find('.auction-countdown').removeClass(function (index, className) {
            return (className.match(/\bauction-countdown-\S+/g) || []).join(' ');
        });
        $("#detailsModal").find('.auction-countdown').addClass('auction-countdown-' + id);
        $("#detailsModal").find('.current-bid').addClass('current-bid-' + id);
    }
</script>
</body>
</html>
