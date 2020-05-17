<?php


namespace App;

use App\Category;
use App\Interfaces\Slidable;
use App\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class CategoriesCollection extends Collection implements Slidable
{
    protected $collection;

    public function __construct()
    {
        return $this;
    }

    public function slider($collection, $sel) {

        $slides = [];

        $items = $collection->all();

        foreach ($items as $key => $item) {
            if ($item->id === $sel->id) {
                $slides['previous'] = isset($items[$key - 1]) ? $items[$key - 1] : null;
                $slides['current'] = $item;
                $slides['next'] = isset($items[$key + 1]) ? $items[$key + 1] : null;
            }
        }

        return $slides;
    }
}