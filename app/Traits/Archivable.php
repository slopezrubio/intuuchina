<?php


namespace App\Traits;

use Illuminate\Support\Str;
use DOMDocument;

trait Archivable
{
    public function loadDataFromFile($root) {
        $document = new DOMDocument();
        $items = [];

        $document->load(storage_path('app/jobs/items.xml'));

        foreach ($document->getElementsByTagName(Str::singular($root)) as $node) {
            $props = [];

            foreach ($node->childNodes as $child) {
                if ($child->nodeName !== '#text') {
                    $props[$child->nodeName] = $child->nodeValue;
                }

            }

            array_push($items, $props);
        }

        return $items;
    }
}