<?php namespace Lepekhin\Clients\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Clients Backend Controller
 */
class Clients extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class,
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Lepekhin.Clients', 'clients', 'clients');
    }
}
