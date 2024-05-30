<?php

namespace Lepekhin\Clients\Models;

use Illuminate\Support\Collection;
use Winter\Storm\Argon\Argon;
use Winter\Storm\Database\Model;

/**
 * Client Model
 *
 * @property string $name Имя
 * @property Argon|null $birthday День рождения
 * @property Collection<Appointment> $appointments Записи
 */
class Client extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'lepekhin_clients_clients';

    public array $rules = [
        'birthday' => 'sometimes|date|nullable',
        'name' => 'string|nullable|max:255',
    ];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public $hasMany = [
        'appointments' => [
            Appointment::class,
            'order' => 'starts_at desc'
        ],
    ];
}
