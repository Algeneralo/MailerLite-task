<?php

namespace Tests\app\Http\Controllers;


use Tests\TestCase;
use App\Models\Subscriber;
use Database\Factories\SubscriberFactory;

class SubscribersControllerTest extends TestCase
{
    public function test_can_list_subscribers()
    {
        SubscriberFactory::new()->count(5)->create();

        $this->getJson('api/v1/subscribers')
            ->assertSuccessful()
            ->assertDataStructure([
                ['id', 'name', 'email', 'state']
            ]);
    }

    public function test_can_show_subscriber()
    {
        SubscriberFactory::new()->count(2)->create();

        $subscriber = Subscriber::find(2);

        $this->getJson("api/v1/subscribers/$subscriber->id")
            ->assertSuccessful()
            ->assertData([
                'id'    => $subscriber->id,
                'email' => $subscriber->email,
                'state' => $subscriber->state
            ]);
    }

    public function test_can_store_subscriber()
    {
        $this->postJson("api/v1/subscribers", [
            'name'  => 'fake',
            'email' => 'fake@gmail.com',
            'state' => 'active'
        ])
            ->assertSuccessful()
            ->assertData([
                'email' => 'fake@gmail.com',
            ]);
    }
}
