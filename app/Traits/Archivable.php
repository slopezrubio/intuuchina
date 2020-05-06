<?php


namespace App\Traits;

use Illuminate\Support\Str;
use DOMDocument;

trait Archivable
{
    public function loadDataFromXMLFile($options = []) {
        $document = new DOMDocument();
        $items = [];

        $document->load($options['path_file']);

        foreach ($document->getElementsByTagName(Str::singular($options['root'])) as $node) {
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