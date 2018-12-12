<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 2;
    	while($i <= 20000){
	        DB::table('events')->insert([
	        	'id' => $i,'title' => $i,'location' => NULL,'bg_type' => 'image','bg_color' => '#B23333','bg_image_path' => 'assets/images/public/EventPage/backgrounds/5.jpg','description' => 'this is a new event '.$i,'start_date' => '2018-11-25 21:26:00','end_date' => '2018-11-25 22:26:00','on_sale_date' => NULL,'account_id' => 1,'user_id' => 1,'currency_id' => '2','sales_volume' => '0.00','organiser_fees_volume' => '0.00','organiser_fee_fixed' => '0.00','organiser_fee_percentage' => '0.000','organiser_id' => intdiv($i, 1000) + 1,'venue_name' => 'Montreal','venue_name_full' => 'Montreal, QC, Canada','location_address' => 'Montreal, QC, Canada','location_address_line_1' => '','location_address_line_2' => 'Montreal','location_country' => 'Canada','location_country_code' => 'CA','location_state' => 'Quebec','location_post_code' => '','location_street_number' => '','location_lat' => '45.5016889','location_long' => '-73.56725599999999','location_google_place_id' => 'ChIJDbdkHFQayUwR7-8fITgxTmU','pre_order_display_message' => NULL,'post_order_display_message' => NULL,'social_share_text' => NULL,'social_show_facebook' => '1','social_show_linkedin' => '1','social_show_twitter' => '1','social_show_email' => '1','social_show_googleplus' => '1','location_is_manual' => '0','is_live' => '0','created_at' => '2018-11-26 02:27:16','updated_at' => '2018-11-26 02:27:16','deleted_at' => NULL,'barcode_type' => 'QRCODE','ticket_border_color' => '#000000','ticket_bg_color' => '#FFFFFF','ticket_text_color' => '#000000','ticket_sub_text_color' => '#999999','social_show_whatsapp' => '1','questions_collection_type' => 'buyer','checkout_timeout_after' => '8','is_1d_barcode_enabled' => '0','enable_offline_payments' => '0','offline_payment_instructions' => NULL
	        ]);

	        $i = $i + 1;
    	}
    }
}
