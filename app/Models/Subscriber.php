<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'state'];

    public static array $default_states = ['active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed'];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function syncFields(array|null $fields = []): void
    {
        if (!$fields) {
            return;
        }
        // this used to sync all the fields
        $this->fields()->delete();

        foreach ($fields as $field) {
            $this->fields()->create([
                'title' => $field['title'],
                'type'  => $field['type'],
            ]);
        }
    }
}