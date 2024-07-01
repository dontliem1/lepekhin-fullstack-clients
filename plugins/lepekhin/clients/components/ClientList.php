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
            'name' => 'ClientList Component',
            'description' => 'Viewing, filtering and sorting clients'
        ];
    }

    public function onRun()
    {
        $this->page['get'] = get();
        $search = get('search');
        $sort = get('sort');
        $inverse = get('inverse');
        $this->page['clients'] = Client::when($search, function (Builder $query, $search) {
            return $query->where(function (Builder $query) use ($search) {
                $searchString = "$search%";
                return $query->where('name', 'like', $searchString);
            });
        })->when($sort, function(Builder $q) use ($sort, $inverse) {
            $q->orderBy($sort, $inverse ? 'desc' : 'asc');
        })
            ->get();
    }
}
