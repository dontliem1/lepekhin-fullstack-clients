<?php

namespace Lepekhin\Clients\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Database\Eloquent\Collection;
use Lepekhin\Clients\Models\Appointment;
use Lepekhin\Clients\Models\Client;
use Winter\Storm\Database\Builder;

class ClientList extends ComponentBase
{
    /**
     * Gets the details for the component
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
        if (request()->ajax()) {
            return response()->json(
                $this->renderPartial('@list', [
                    'clients' => $this->getClients(),
                ])
            );
        }

        $this->page['get'] = get();
        $this->page['clients'] = $this->getClients();
    }

    /**
     * @return Collection
     */
    private function getClients(): Collection
    {
        $search = get('search');
        $sort = get('sort');
        $order = get('inverse') ? 'desc' : 'asc';

        return Client::query()
            ->when($search, function (Builder $query, $search) {
                return $query->where(function (Builder $query) use ($search) {
                    $searchString = "$search%";
                    return $query->where('name', 'like', $searchString);
                });
            })
//            ->inRandomOrder(/* TODO: sort clients https://wintercms.com/docs/v1.2/docs/database/query#ordering-grouping-limit--offset */)
            ->when(
                $sort,
                function (Builder $query) use ($sort, $order) {
                    match ($sort) {
                        'name' => $query->select('name')
                            ->orderBy('name', $order),
                        'birthday' => $query->select('name', 'birthday')
                            ->orderBy('birthday', $order),
                        'last_appointment' => $query->with('appointments')
                            ->select('id', 'name')
                            ->orderBy(
                                Appointment::query()
                                    ->select('starts_at')
                                    ->whereColumn(
                                        'lepekhin_clients_appointments.client_id',
                                        'lepekhin_clients_clients.id'
                                    )
                                    ->oldest('starts_at')
                                    ->take(1),
                                $order
                            ),
                        default => $query,
                    };
                }
            )
            ->get();
    }
}
