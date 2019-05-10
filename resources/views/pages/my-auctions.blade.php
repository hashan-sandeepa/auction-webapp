<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | My Bids</title>
    <link href="{{ asset('assets/css/my-auction.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="container">
    <!--include header-->
@include('pages.header')
<!--include navigation bar-->
    @include('pages.nav')

    <div id="content">
        <!--Place page specific content here-->
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>Acer Laptop</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/sell/acer.jpg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Start Date: </p>
                    <p>End Date: </p>
                    <p>Current Bid: </p>
                    <p>Countdown: </p>
                </div>
                <div class="prod-desc">
                    <p class="start-date">27/07/2018 15:33:50</p>
                    <p class="end-date">05/08/2018 20:00:00</p>
                    <p class="current-bid">$ 250.00</p>
                    <p class="auction-countdown">00:27:43</p>
                </div>
            </div>
        </div>
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>Google Pixel 2</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/sell/pixel2.jpg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Start Date: </p>
                    <p>End Date: </p>
                    <p>Current Bid: </p>
                    <p>Countdown: </p>
                </div>
                <div class="prod-desc">
                    <p class="start-date">28/07/2018 11:24:20</p>
                    <p class="end-date">03/08/2018 19:00:00</p>
                    <p class="current-bid">$ 467.00</p>
                    <p class="auction-countdown">19:27:43</p>
                </div>
            </div>
        </div>
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>Seiko 5</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/sell/seiko-5.jpg') }}" width="200">
                </div>
                <div class="prod-desc-label">
                    <p>Start Date: </p>
                    <p>End Date: </p>
                    <p>Current Bid: </p>
                    <p>Countdown: </p>
                </div>
                <div class="prod-desc">
                    <p class="start-date">29/07/2018 12:55:10</p>
                    <p class="end-date">06/08/2018 20:00:00</p>
                    <p class="current-bid">$ 95.00</p>
                    <p class="auction-countdown">00:27:43</p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        Copyright © 2018 All rights reserved
    </footer>
</div>
</body>
</html>
	