<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('assets/css/nav.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="sidebar">
    <div id="sidebar-content">
        <ul>
            <li @if(@isset($isHome) && $isHome){!! 'class="active"' !!}@endif >
                <a href="/" class="none-txt-decorations">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            @if (Auth::check())
                <li @if(@isset($isMyAuction) && $isMyAuction){!! 'class="active"' !!}@endif >
                    <a href="/auction/my/auctions" class="none-txt-decorations">
                        <i class="fas fa-gavel"></i>
                    </a>
                </li>
                <li @if(@isset($isCallAuction) && $isCallAuction){!! 'class="active"' !!}@endif >
                    <a href="/auction/call" class="none-txt-decorations">
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li @if(@isset($isMyBids) && $isMyBids){!! 'class="active"' !!}@endif >
                    <a href="/auction/bid/my/bids" class="none-txt-decorations">
                        <i class="fas fa-dollar-sign"></i>
                    </a>
                </li>
            @endif
            <li @if(@isset($isHelp) && $isHelp){!! 'class="active"' !!}@endif >
                <a href="/help" class="none-txt-decorations">
                    <i class="fas fa-question"></i>
                </a>
            </li>
            <li @if(@isset($isAbout) && $isAbout){!! 'class="active"' !!}@endif >
                <a href="/about" class="none-txt-decorations">
                    <i class="fas fa-exclamation-circle"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
</body>
<html>