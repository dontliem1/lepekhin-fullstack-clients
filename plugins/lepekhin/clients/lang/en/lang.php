<?php

return [
    'plugin' => [
        'name' => 'Clients',
        'description' => 'Plugin with the test task',
    ],
    'permissions' => [
        'some_permission' => 'Some permission',
    ],
    'models' => [
        'general' => [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'appointment' => [
            'title_singular' => 'Appointment',
            'title_plural' => 'Appointments',
            'starts_at' => 'Starts At',
            'label' => 'Appointment',
            'label_plural' => 'Appointments',
        ],
        'client' => [
            'title_singular' => 'Client',
            'title_plural' => 'Clients',
            'birthday' => 'Birthday',
            'name' => 'Name',
            'label' => 'Client',
            'label_plural' => 'Clients',
        ],
    ],
];
