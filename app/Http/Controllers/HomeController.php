<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class HomeController extends Controller
{
    public function getHomePage(Request $request)
    {
        $criteria = $request->criteria;
        Log::info('Criteria :' . $criteria);

        $category = $request->category;

        $categoryNames = null;
        $query = '';
        if (isset($criteria) || isset($category)) {
            $query = Auction::where([['start_at', '<=', Carbon::now()], ['end_at', '>', Carbon::now()]]);


            if (isset($criteria)) {
                $query->where(function ($query) use ($criteria) {
                    return $query->orWhere('description', 'like', '%' . $criteria . '%')->orWhere('title', 'like', '%' . $criteria . '%');
                });
            }

            if (isset($category)) {
                Log::info('Category :' . implode(", ", $category));
                $query->whereIn('category_id', $category);

                $categoryNames = Category::whereIn('id', $category)->get(['name']);
                Log::info('Category Names : ' . $categoryNames);
            }
        } else {
            $query = Auction::where([['start_at', '<=', Carbon::now()], ['end_at', '>', Carbon::now()]]);
        }
        $query->take(10)->with('user', 'category');

        Log::info('SQL : ' . $query->toSql());
        Log::info('Params : ' . implode(", ", $query->getBindings()));
        $auctions = $query->get();
        foreach ($auctions as $index => $auction) {
            Log::info('Auction : ' . $auction);
            #Update latest bid if it's greater than starting bid
            $latestBid = Bid::where('auction_id', '=', (int)$auction->id)->orderBy('created_at', 'DESC')->pluck('amount')->first();
            Log::info('Latest Bid : ' . $latestBid . ' Starting Bid : ' . $auction->starting_bid);
            if ($latestBid > ($auction->starting_bid)) {
                $auctions[$index]['starting_bid'] = $latestBid;
            }
        }


        Log::info('Auctions : ' . $auctions);
        return view("index", ["isHome" => true])->with(['auctions' => $auctions, 'criteria' => $criteria, 'categories' => $categoryNames]);
    }
}
