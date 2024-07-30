<?php

namespace Lepekhin\Clients\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Winter\Storm\Database\Model;

/**
 * Appointment Model
 *
 * @property Argon $starts_at Время записи
 * @property Client $client Клиент
 */
class Appointment extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'lepekhin_clients_appointments';

    public array $rules = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'starts_at',
    ];

    public $belongsTo = [
        'client' => Client::class,
    ];

    /**
     * @return Attribute
     */
    protected function humanStartsAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->starts_at
                ? $this->starts_at->locale('ru')->isoFormat('LLLL')
                : null,
        );
    }
}
