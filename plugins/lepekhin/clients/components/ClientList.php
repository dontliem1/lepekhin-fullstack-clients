<?php

namespace Lepekhin\Clients\Components;

use Cms\Classes\ComponentBase;
use Lepekhin\Clients\Models\Client;
use Winter\Storm\Database\Builder;

class ClientList extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'ClientList Component',
            'description' => 'Viewing, filtering and sorting clients'
        ];
    }

    public function onRun()
    {
        $this->page['get'] = get();
        $search = get('search');
        $this->page['clients'] = Client::when($search, function (Builder $query, $search) {
            return $query->where(function (Builder $query) use ($search) {
                $searchString = "$search%";
                return $query->where('name', 'like', $searchString);
            });
        })->inRandomOrder(/* TODO: sort clients https://wintercms.com/docs/v1.2/docs/database/query#ordering-grouping-limit--offset */)->get();
    }
}
