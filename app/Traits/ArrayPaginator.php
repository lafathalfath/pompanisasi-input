<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait ArrayPaginator
{
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginatedItems = $items->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $paginatedItems, 
            $items->count(), 
            $perPage, 
            $page, 
            $options
        );
    }
}