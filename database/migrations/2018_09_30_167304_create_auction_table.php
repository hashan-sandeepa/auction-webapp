<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('title', 100);
            $table->integer('category_id')->unsigned();
            $table->string('description', 1000);
            $table->mediumText('image_paths')->nullable();
            $table->decimal('starting_bid', 11, 2);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });

        Schema::table('auction', function ($table) {
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
        });

        // Insert default user record
        DB::table('auction')->insert([
            array('user_id' => '1', 'title' => 'Samsung S9', 'category_id' => 3,
                'description' => 'Released 2018, March 163g, 8.5mm thickness Android 8.0 64/128/256GB storage, microSD card slot',
                'image_paths' => 'auctions/3/auction-photo-4.jpg|auctions/3/auction-photo-1.jpg|auctions/3/auction-photo-2.jpg|auctions/3/auction-photo-3.jpg',
                'starting_bid' => 479.00, 'start_at' => '2018-10-02 21:10:00',
                'end_at' => '2018-10-06 12:07:00'),
            array('user_id' => '1', 'title' => 'Adidas Originals', 'category_id' => 5,
                'description' => 'This t-shirt spells out your pride in Juventus winning brand of soccer. Made from soft single jersey fabric, it displays an oversize club badge on the back.Regular fit is wider at the body, with a straight silhouette Imported 100% cotton single jersey',
                'image_paths' => 'auctions/2/auction-photo-1.jpg|auctions/2/auction-photo-2.jpg|auctions/2/auction-photo-3.jpg|auctions/2/auction-photo-4.jpg',
                'starting_bid' => 20.00, 'start_at' => '2018-10-02 19:04:00',
                'end_at' => '2018-10-14 19:07:00'),
            array('user_id' => '1', 'title' => 'Dell XPS 13', 'category_id' => 2,
                'description' => 'The smallest 13.3-inch on the planet with the world’s first InfinityEdge display More screen, less to carry: The virtually borderless InfinityEdge display maximizes screen space by squeezing a 13.3-inch display in an 11-inch frame. With a bezel only 5.2 mm thin, starting at only 2.7 pounds and measuring a super slim 9-15 mm, the XPS 13 is exceptionally thin and light.',
                'image_paths' => 'auctions/1/auction-photo-1.jpg',
                'starting_bid' => 698.00, 'start_at' => '2018-10-02 17:06:00',
                'end_at' => '2018-10-07 09:05:00'),
            array('user_id' => '1', 'title' => 'Nike Sport Shoe', 'category_id' => 11,
                'description' => 'Beveled heel and rubber outsole strip help you land in a good position and transition smoothly
Raised rubber sections on the bottom of the shoe provide traction
Offset: 10mm
Shown: Barely Grey/Geode Teal/Black/Hot Punch
Style: AV2320-063',
                'image_paths' => 'auctions/4/auction-photo-1.jpg|auctions/4/auction-photo-2.jpg',
                'starting_bid' => 80.00, 'start_at' => '2018-10-02 15:29:29',
                'end_at' => '2018-10-08 15:29:31'),
            array('user_id' => '1', 'title' => 'Apple Watch Series 3', 'category_id' => 10,
                'description' => '➤ Apple Watch Series 3 42mm GPS ONLY
➤ MQL12LL/A Space Gray Aluminum Case with Black Sports Band
➤ Built-in GPS and GLONASS
➤ Water resistant 50 meters2
➤ Up to 18 hours of battery life3',
                'image_paths' => 'auctions/5/auction-photo-1.jpg',
                'starting_bid' => 250.00, 'start_at' => '2018-10-06 15:32:36',
                'end_at' => '2018-10-22 15:32:40'),
            array('user_id' => '1', 'title' => 'Beats Studio3', 'category_id' => 12,
                'description' => 'Pure adaptive noise canceling (pure ANC) actively blocks external noise
Real-time Audio calibration preserves a Premium listening experience
Up to 22 hours of battery life enables full-featured all-day wireless playback
Apple W1 chip for class 1 wireless Bluetooth connectivity & battery efficiency
With fast Fuel, a 10-minute charge gives 3 hours of play when battery is low',
                'image_paths' => 'auctions/6/auction-photo-1.jpg',
                'starting_bid' => 310.00, 'start_at' => '2018-10-06 15:36:16',
                'end_at' => '2018-10-22 15:36:19'),
            array('user_id' => '1', 'title' => 'Apple iPhone X', 'category_id' => 3,
                'description' => 'An all‑new 5.8‑inch Super Retina screen with all-screen OLED Multi-Touch display
12MP wide-angle and telephoto cameras with Dual optical image stabilization
Wireless Qi charging
Splash, water, and dust resistant
Sapphire crystal lens cover',
                'image_paths' => 'auctions/7/auction-photo-1.jpg',
                'starting_bid' => 784.00, 'start_at' => '2018-10-05 15:38:12',
                'end_at' => '2018-10-08 15:38:15')
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction');
    }
}
