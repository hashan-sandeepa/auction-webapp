<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Dto\ResponseDto;
use Auth;
use DB;
use Illuminate\Http\Request;
use Log;
use Validator;

class BidController extends Controller
{
    public function getMyBidPage()
    {
        return view('pages/my-bids', ["isMyBids" => true]);
    }

    public function placeBid(Request $request)
    {
        $auctionId = $request->auctionId;
        Log::info('auctionId :' . $auctionId);

        $amount = $request->amount;
        Log::info('amount : ' . $amount);

        $currentBid = Bid::where('auction_id', '=', (int)$auctionId)->orderBy('created_at', 'DESC')->pluck('amount')->first();
        if (!isset($currentBid)) {
            $currentBid = Auction::where('id', '=', (int)$auctionId)->pluck('starting_bid')->first();
        }
        Log::info('currentBid : ' . $currentBid);

        $v = Validator::make($request->all(), [
            'auctionId' => 'required|integer|exists:auction,id',
            'amount' => 'required|min:0.01|regex:/^\d*(\.\d{2})?$/|gt:' . (float)$currentBid
        ], [
            'amount.regex' => 'Invalid Bid amount',
            'amount.min' => 'Invalid Bid amount',
            'amount.gt' => 'Bid amount must be greater than current bid',
        ]);

        if ($v->fails()) {
            $error = $v->errors()->first();
            Log::error('validation error :' . $error);
            return response()->json(new ResponseDto(true, array($error), null));
        } else {
            try {
                #insert bid record
                $bid = Bid::create([
                    'auction_id' => $auctionId,
                    'user_id' => Auth::id(),
                    'amount' => $amount
                ]);

                Log::info('Bid : ' . $bid);
            } catch (QueryException $ex) {
                Log::error('error :' . $ex->getMessage());
                return response()->json(new ResponseDto(true, array($ex->getMessage()), null));
            }

            $latestBid = Bid::where('auction_id', '=', (int)$auctionId)->orderBy('created_at', 'DESC')->pluck('amount')->first();
            return response()->json(new ResponseDto(false, null, $latestBid));
        }
    }

    public function getBidHistory($id)
    {
        Log::info('auctionId :' . $id);
        $bidhistory = Bid::where('auction_id', '=', (int)$id)->orderBy('created_at', 'DESC')->with('user', 'auction')->get();
        Log::info('Bid History :' . $bidhistory);

        return response()->json($bidhistory);

    }

    public function getLatestBid(Request $request)
    {
        $auctionIds = $request->auctionIds;
        $latestBid = 0.00;
        if (isset($auctionIds)) {
            Log::info('Auction Ids : ' . implode($auctionIds, ', '));

            $latestBid = Bid::select(DB::raw('auction_id, MAX(amount) as amount'))->whereIn('auction_id', $auctionIds)->groupBy('auction_id')->orderBy('auction_id', 'DESC')->get();
            Log::info('Latest Bids : ' . $latestBid);
        }
        return response()->json($latestBid);
    }
}
