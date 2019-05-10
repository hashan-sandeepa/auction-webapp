<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | My Bids</title>
    <link href="{{ asset('assets/css/my-bids.css') }}" type="text/css" rel="stylesheet">
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
                <div class="prod-title"><p>Adidas Originals</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/buy/sample-auction-img1.jpg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Your Max Bid: </p>
                    <p>Countdown: </p>
                    <p>Current Bid: </p>
                    <p>
                        <button class="increase-bid-button">Increase Bid</button>
                    </p>
                </div>
                <div class="prod-desc">
                    <p class="my-bid">$ 20.00</p>
                    <p class="auction-countdown">00:27:43</p>
                    <p class="current-bid">$ 25.00</p>
                    <p>$ <input class="increase-bid" type="number" name="IncreaseBid"></p>
                </div>
            </div>
        </div>
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>Nike AirMax</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/buy/nikeairmax98.jpg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Your Max Bid: </p>
                    <p>Countdown: </p>
                    <p>Current Bid: </p>
                    <p>
                        <button class="increase-bid-button">Increase Bid</button>
                    </p>
                </div>
                <div class="prod-desc">
                    <p class="my-bid">$ 78.00</p>
                    <p class="auction-countdown">02:56:23</p>
                    <p class="current-bid">$ 78.00</p>
                    <p>$ <input class="increase-bid" type="number" name="IncreaseBid"></p>
                </div>
            </div>
        </div>
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>Apple Watch SE</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/buy/applewatchse.jpg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Your Max Bid: </p>
                    <p>Countdown: </p>
                    <p>Current Bid: </p>
                    <p>
                        <button class="increase-bid-button">Increase Bid</button>
                    </p>
                </div>
                <div class="prod-desc">
                    <p class="my-bid">$ 78.00</p>
                    <p class="auction-countdown">02:56:23</p>
                    <p class="current-bid">$ 78.00</p>
                    <p>$ <input class="increase-bid" type="number" name="IncreaseBid"></p>
                </div>
            </div>
        </div>
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>JBL Flip</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/buy/jbl-flip.jpeg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Your Max Bid: </p>
                    <p>Countdown: </p>
                    <p>Current Bid: </p>
                    <p>
                        <button class="increase-bid-button">Increase Bid</button>
                    </p>
                </div>
                <div class="prod-desc">
                    <p class="my-bid">$ 50.00</p>
                    <p class="auction-countdown">22:40:22</p>
                    <p class="current-bid">$ 66.00</p>
                    <p>$ <input class="increase-bid" type="number" name="IncreaseBid"></p>
                </div>
            </div>
        </div>
        <div class="auctions-container">
            <div class="product-card">
                <div class="prod-title"><p>Rayban Wayfarer</p></div>
                <div class="prod-img">
                    <img src="{{ asset('assets/img/buy/rayban-wayfarer.jpeg') }}" width="220">
                </div>
                <div class="prod-desc-label">
                    <p>Your Max Bid: </p>
                    <p>Countdown: </p>
                    <p>Current Bid: </p>
                    <p>
                        <button class="increase-bid-button">Increase Bid</button>
                    </p>
                </div>
                <div class="prod-desc">
                    <p class="my-bid">$ 98.00</p>
                    <p class="auction-countdown">01:12:43</p>
                    <p class="current-bid">$ 98.00</p>
                    <p>$ <input class="increase-bid" type="number" name="IncreaseBid"></p>
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
