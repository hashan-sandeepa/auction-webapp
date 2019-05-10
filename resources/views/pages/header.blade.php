<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ asset('assets/css/stroke-icons/style.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/css/alert.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/css/header.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/all.css') }}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/header.js') }}"></script>
</head>
<body>
<header>

    <a href="/" class="none-txt-decorations">
        <img id="logo" src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="100%" width="auto"
             class="vertical-middle"/>
        <p class="heading1 dispaly-inline vertical-middle colored-first-letter">My</p>
        <p class="heading1 dispaly-inline vertical-middle colored-first-letter">Auction</p>
    </a>


    <a class="none-txt-decorations" id="user-profile" onclick="showMenu();">
        <img id="user-profile-img" src="/user/my/profile/image">
    </a>

    <div id="sub-menu">
        @if (Auth::check())<p class="logged-user">Hi {{Auth::user()->first_name}} !</p>@endif
        <ul @if (Auth::check())style="margin-top: 5px;"@endif>
            @if (Auth::check())
                <a href="/user/my/profile">
                    <li><i class="far fa-user"></i><span class="menu-item-lbl">My Profile</span></li>
                </a>
                <a href="/user/logout">
                    <li><i class="fas fa-sign-out-alt"></i><span class="menu-item-lbl">Logout</span></li>
                </a>
            @else
                <a href="/user/login">
                    <li><i class="fas fa-sign-in-alt"></i><span class="menu-item-lbl">Login</span></li>
                </a>
                <a href="/user/register">
                    <li><i class="fas fa-user-plus"></i><span class="menu-item-lbl">Register</span></li>
                </a>
            @endif
        </ul>
    </div>


    <div id="searchBoxContainer">
        <input id="searchBox" type="text" name="criteria" placeholder="Search...">
        <a href="#" id="searchButton" class="none-txt-decorations" onclick="doSearch();">
            <i class="fas fa-search"></i>
        </a>
    </div>

    <form id="search-category">
        <ul>

        </ul>
    </form>
</header>
<div id="alert-container"></div>
<script type="text/javascript">
    var _alert_container = $('#alert-container');

    @if(session()->get( 'message' ))
    alert.success(_alert_container, '{{session()->get( 'message' )}}');
    @elseif(session()->get( 'warning' ))
    alert.warning(_alert_container, '{{session()->get( 'warning' )}}');
    @elseif(session()->get( 'error' ))
    alert.danger(_alert_container, '{{session()->get( 'error' )}}');
            @endif

            @if(@isset($auctions))
    var auctions = {!! json_encode($auctions->toArray()) !!};
    document.addEventListener("DOMContentLoaded", function (event) {

        // Set the counting down date
        var countDownDate;

        // Update the count down every 1 second
        var x = setInterval(function () {
            // Get todays date and time
            var now = new Date().getTime();

            $.each(auctions, function (index, auction) {
                countDownDate = new Date(auction.end_at);

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an elements
                var elem = $(".auction-countdown-" + auction.id);

                elem.html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");

                if (distance < 0) {
                    clearInterval(x);
                    elem.html("EXPIRED");
                }
            });
        }, 1000);
    });

    var auctionIds = new Array();
    $.each(auctions, function (index, auction) {
        auctionIds.push(auction.id);
    });

    setInterval(function () {
        $.ajax({
            url: "/auction/bid/latest",
            type: "POST",
            data: {
                _token: CSRF_TOKEN,
                auctionIds: auctionIds
            },
            success: function (response) {
                $.each(response, function (index, obj) {
                    $(".current-bid-" + obj.auction_id).html('$' + obj.amount);
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert.danger(_alert_container, "Unexpected error occurred when fetching latest bid : Error Code - " +
                    jqXHR.status);
            }
        });
    }, 10000);
    @endif
</script>
</body>
</html>
