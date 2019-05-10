<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Log;
use Validator;

class AuctionController extends Controller
{
    public function getMyAuctionPage()
    {
        return view('pages/my-auctions', ["isMyAuction" => true]);
    }

    public function getCallAuctionPage()
    {
        return view('pages/call-auction', ["isCallAuction" => true]);
    }

    public function callAuction(Request $request)
    {
        $title = $request->title;
        Log::info('title :' . $title);

        $category = $request->category;
        Log::info('category : ' . $category);

        $description = $request->description;
        Log::info('description : ' . $description);

        $startingBid = $request->startingBid;
        Log::info('startingBid : ' . $startingBid);

        $startAt = $request->startAt;
        Log::info('startAt : ' . $startAt);

        $endAt = $request->endAt;
        Log::info('endAt : ' . $endAt);


        $v = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'category' => 'required|integer|exists:category,id',
            'description' => array(
                'required',
                'max:250',
            ),
            'startingBid' => 'required|min:0.01|regex:/^\d*(\.\d{2})?$/',
            'startAt' => 'required|date|date_format:Y-m-d\TH:i',
            'endAt' => 'required|date|date_format:Y-m-d\TH:i',
            'images.*' => array(
                'required',
                'image',
                'mimes:jpg,jpeg,png,bmp,gif,webp',
                'max:2048'
            ),
            'images' => 'max:5'
        ], [

            'images.*.required' => 'Please upload an image',
            'images.*.mimes' => 'Only jpg, jpeg, png, bmp, gif and webp images are allowed',
            'images.*.max' => 'Maximum allowed size for an image is 2MB',
            'startingBid.regex' => 'Invalid Starting bid amount',
            'startingBid.min' => 'Invalid Starting bid amount',
        ]);

        if ($v->fails()) {
            $error = $v->errors()->first();
            Log::error('validation error :' . $error);
            return redirect()->back()->with('error', $error)->withInput(Input::all());
        } else {
            try {
                //insert auction data
                $auction = Auction::create([
                    'user_id' => Auth::id(),
                    'title' => $title,
                    'category_id' => $category,
                    'description' => $description,
                    'starting_bid' => $startingBid,
                    'start_at' => $startAt,
                    'end_at' => $endAt
                ]);

                $images = $request->file('images');

                if ($request->hasFile('images')) {
                    $imagesPaths = '';
                    foreach ($images as $index => $image) {
                        // generate a new filename. getClientOriginalExtension() for the file extension
                        $filename = 'auction-photo-' . ($index + 1) . '.' . $image->getClientOriginalExtension();
                        Log::info('File Name :' . $filename);

                        $auctionPicDir = env("AUCTION_PICTURE_UPLOAD_DIR", "auctions");
                        Log::info('Root Dir :' . $auctionPicDir);
                        Log::info('Upload Dir :' . $auctionPicDir . '/' . $auction->id);

                        // save to storage/app/auctions as the new $filename
                        $path = $image->storeAs($auctionPicDir . '/' . $auction->id, $filename);
                        $imagesPaths = $imagesPaths != '' ? ($imagesPaths . '|' . $path) : $path;
                    }
                    $auction->image_paths = $imagesPaths;
                    $auction->save();
                }
            } catch (QueryException $ex) {
                Log::error('error :' . $ex->getMessage());
                return redirect()->back()->with('error', 'processing error...')->withInput(Input::all());
            }
            return redirect()->route('home')->with('message', 'You call auction successfully');
        }
    }

    public function getImage($path)
    {
        $path = 'app' . '/' . str_replace('%', '/', $path);
        Log::info('path :' . $path);
        return Image::make(storage_path($path))->response();
    }

    public function getAuctionInfo($id)
    {
        $auction = Auction::where('id', '=', $id)->first();

        //update latest bid
        $latestBid = Bid::where('auction_id', '=', (int)$id)->orderBy('created_at', 'DESC')->pluck('amount')->first();
        if (isset($latestBid)) {
            $auction->starting_bid = $latestBid;
        }

        return response()->json($auction);
    }
}
