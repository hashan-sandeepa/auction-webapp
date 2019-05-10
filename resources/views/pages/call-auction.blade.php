<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | Call Auction</title>
    <link href="{{ asset('assets/css/call-auction.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="container">
    <!--include header-->
@include('pages.header')
<!--include navigation bar-->
    @include('pages.nav')

    <div id="content">
        <div id="form-container">
            <h3 id="heading">Call Auction</h3>
            <form method="POST" action="/auction/call" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table style="width: 92%">
                    <tbody>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="title" name="title" placeholder="Title" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select id="category" name="category" required>
                                <option value="0">Select category</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td>
                            <textarea id="description" name="description" placeholder="Description"
                                      maxlength="1000" required></textarea>
                            <p id="desc-count"><span id="charCount">0</span>/1000</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="startingBid" name="startingBid" placeholder="Starting Bid" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="startAt" name="startAt" placeholder="Start at"
                                   onfocus="(this.type='datetime-local')" onblur="(this.type='text')" required></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="endAt" name="endAt" placeholder="Ends at"
                                   onfocus="(this.type='datetime-local')" onblur="(this.type='text')" required></td>
                    </tr>

                    </tbody>
                </table>
                <table style="width: 100%;margin-top: 5px">
                    <tbody>
                    <tr>
                        <td class="required"></td>
                        <td>
                            <input type="file" id="images" name="images[]" accept="image/x-png,image/gif,image/jpeg"
                                   multiple required>
                            <div>
                                <div id="image-container"></div>
                                <div id="browse-images"><i class="fas fa-plus"></i></div>
                                <p id="img-upload-message">*Maximum 5 images</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-orange">Publish</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery.maskMoney.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/call-auction.js') }}" type="text/javascript"></script>
</body>
</html>
 