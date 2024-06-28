<?php

namespace Lepekhin\Clients\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Lepekhin\Clients\Models\Client;
use Winter\Storm\Database\Builder;

class ClientList extends ComponentBase
{
    /**
     * @inheritDoc
     */
    public function componentDetails(): array
    {
        return [
            'name' => 'ClientList Component',
            'description' => 'Viewing, filtering and sorting clients'
        ];
    }


    public function onRun()
    {
        if (Request::ajax()) {
            return $this->renderClientList();
        }

        $this->page['clients'] = $this->loadClients();
    }

    /**
     * @return Collection
     */
    protected function loadClients(): Collection
    {
        $search = Request::get('search');
        $sort = Request::get('sort');
        $inverse = Request::get('inverse');
        Carbon::setLocale('ru');

        return Client::when($search, function (Builder $query, $search) {
            $searchString = "$search%";
            return $query->where('name', 'like', $searchString);
        })->when($sort, function (Builder $query, $sort) {
            switch ($sort) {
                case 'name':
                    return $query->select('name')->orderBy('name');
                case 'birthday':
                    return $query->select('name', 'birthday')->orderBy('birthday');
                case 'last_appointment':
                    return $query->select('id', 'name')->whereHas('appointments', function (Builder $query) {
                        $query->orderBy('starts_at');
                    })->with(['appointments']);
                default:
                    break;
            }
        })
            ->when($inverse, function (Builder $query) {
                $query->orderBy('id');
            })
            ->when(!$search && !$sort && !$inverse, function (Builder $query) {
                $query->inRandomOrder();
            })
            ->get();
    }

    /**
     * @return JsonResponse
     */
    protected function renderClientList(): JsonResponse
    {
        $renderedClients = $this->renderPartial('@list', [
            'clients' => $this->loadClients(),
        ]);

        return Response::json($renderedClients);
    }
}
