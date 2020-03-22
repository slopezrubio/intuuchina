<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    const ELEMENTS_PER_PAGE = 3;

    protected $collectables = ['users', 'testimonials', 'offers'];

    public function index(Request $request) {
        $data = $this->getCollections();

        return view('pages.admin.dashboard', compact('data'));
    }

    public function getCollections() {
        $collections = [];

        foreach($this->collectables as $key => $collectable) {
            $currentPage = 1;
            $collectionClass = 'App\\' . ucfirst($collectable) . 'Collection';
            $collections[$collectable] = new $collectionClass([], 'admin');

            if ($collectable === $this->getRequestedCollectable()) {
                $collections['selected'] = $collectable;
                $collections[$collectable]->match();
                $currentPage = null;
            }

            $collections[$collectable] = $collections[$collectable]->paginate(self::ELEMENTS_PER_PAGE, null, $currentPage)->withPath(route('admin.' . $collectable));
        }

        return $collections;
    }

    private function getRequestedCollectable() {
        return request()->segment(count(request()->segments()));
    }
}
