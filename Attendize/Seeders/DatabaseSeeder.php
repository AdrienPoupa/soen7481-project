<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        /*$this->call('CountriesSeeder');
        $this->call('CurrencySeeder');
        $this->call('OrderStatusSeeder');
        $this->call('PaymentGatewaySeeder');
        $this->call('QuestionTypesSeeder');
        $this->call('TicketStatusSeeder');
        $this->call('TimezoneSeeder');*/

        $this->call('AccountTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('OrganisersTableSeeder');
        $this->call('EventsTableSeeder');
        $this->call('OrderTableSeeder');
        $this->call('OrderItemsTableSeeder');
        $this->call('TicketsTableSeeder');
        $this->call('AttendeesTableSeeder');
    }
}
