<?php

namespace Tests\app\Models;


use Tests\TestCase;
use Database\Factories\SubscriberFactory;

class SubscriberTest extends TestCase
{
    public function testSyncFields()
    {
        $subscriber = SubscriberFactory::new()->create();

        $this->assertEquals(0, $subscriber->fields()->count());

        $subscriber->syncFields([
            ['title' => 'fake new', 'type' => 'date'],
            ['title' => 'new fake', 'type' => 'date'],
        ]);

        $this->assertEquals(2, $subscriber->fields()->count());
    }
}
