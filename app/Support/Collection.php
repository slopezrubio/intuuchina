<?php


namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as BaseCollection;


class Collection extends BaseCollection
{
    /**
     * Paginate a standard Laravel Collection.
     *
     * @param int $perPage
     * @param int $total
     * @param int $page
     * @param string $pageName
     * @return LengthAwarePaginator
     */
    public function paginate($perPage, $total = null, $page = null, $pageName = 'page') {
        $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

        return new LengthAwarePaginator(
            $this->collection->forPage($page, $perPage),
            $total ?: $this->collection->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}