<?php

namespace Lepekhin\Clients;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;

/**
 * Clients Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'lepekhin.clients::lang.plugin.name',
            'description' => 'lepekhin.clients::lang.plugin.description',
            'author'      => 'Lepekhin',
            'icon'        => 'icon-group'
        ];
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [
            'Lepekhin\Clients\Components\ClientList' => 'ClientList',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return []; // Remove this line to activate

        return [
            'lepekhin.clients.some_permission' => [
                'tab' => 'lepekhin.clients::lang.plugin.name',
                'label' => 'lepekhin.clients::lang.permissions.some_permission',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return [
            'clients' => [
                'label'       => 'lepekhin.clients::lang.plugin.name',
                'url'         => Backend::url('lepekhin/clients/clients'),
                'icon'        => 'icon-group',
                'permissions' => ['lepekhin.clients.*'],
                'order'       => 500,
                'sideMenu'    => [
                    'clients' => [
                        'label' => 'lepekhin.clients::lang.models.client.title_plural',
                        'url' => Backend::url('lepekhin/clients/clients'),
                        'icon' => 'icon-user',
                    ],
                    'appointments' => [
                        'label' => 'lepekhin.clients::lang.models.appointment.title_plural',
                        'url' => Backend::url('lepekhin/clients/appointments'),
                        'icon' => 'icon-calendar',
                    ],
                ],
            ],
        ];
    }
}
