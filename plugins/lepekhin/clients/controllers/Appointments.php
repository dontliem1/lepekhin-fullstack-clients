<?php namespace Lepekhin\Clients\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Appointments Backend Controller
 */
class Appointments extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Lepekhin.Clients', 'clients', 'appointments');
    }
}
