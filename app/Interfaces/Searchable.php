<?php


namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


interface Searchable
{
    public function match() ;
    public function hasSearchKeys() ;
}