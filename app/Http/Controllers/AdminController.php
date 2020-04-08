<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $collectables = ['users', 'testimonials', 'offers'];
    protected $current = null;

    const ADMIN_ELEMENTS_PER_PAGE = 9;

    public function index(Request $request) {
        $collections = $this->getCollections($request);

        return view('pages.admin.dashboard', [
            'data' => $collections,
            'selected' => $this->current
        ]);
    }

    public function getCollections(Request $request) {
        $collections = [];

        foreach($this->collectables as $key => $collectable) {
            $currentPage = 1;
            $collectionClass = 'App\\' . ucfirst($collectable) . 'Collection';
            $collection = new $collectionClass([], 'admin');

            $collections[$collectable] = $collection->paginate(self::ADMIN_ELEMENTS_PER_PAGE, null, $currentPage)->withPath(route('admin.' . $collectable));

            if ($this->isCollectionRequested($collectable)) {
                $this->current = $collectable;

                if (method_exists($collection, 'hasSearchKeys')) {
                    if ($collection->hasSearchKeys()) {
                        $currentPage = null;

                        $collections[$collectable] = $collection->match()
                                                        ->paginate(self::ADMIN_ELEMENTS_PER_PAGE, null, $currentPage)
                                                        ->setPath(route('admin.' . $collectable))
                                                        ->appends('search', request()->query('search'));
                    }
                }
            };
        }

        return $collections;
    }

    private function isCollectionRequested($name) {
        return request()->segment(count(request()->segments())) === $name;
    }
}
