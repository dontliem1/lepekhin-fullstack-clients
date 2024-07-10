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
        // Получение параметров запроса
        $this->page['get'] = get();
        $search = trim(get('search'));
        $sort = get('sort');
        $inverse = get('inverse') === 'on';

        $query = Client::when($search, function (Builder $query, $search) {
            return $query->where(function (Builder $query) use ($search) {
                $searchString = "%$search%";
                return $query->where('name', 'like', $searchString)
                    ->orderByDesc('name');
            });
        });

        if ($sort) {
            if ($inverse) {
                $query->orderByDesc($sort);
            } else {
                $query->orderBy($sort);
            }
        }

        if (!empty($search)) {
            $this->page['clients'] = $query->get('name');
        } else {
            $this->page['clients'] = $query->get();
        }

    }
}
