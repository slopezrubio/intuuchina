<?php

use App\Category;
use App\Traits\Archivable;
use App\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class OffersTableSeeder extends Seeder
{
    use Archivable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = $this->loadDataFromXMLFile([
            'root' => 'offers',
            'path_file' => storage_path('app/jobs/items.xml')
        ]);

        foreach ($offers as $offer) {
            Offer::create([
                'id' => $offer['id'],
                'title' => $offer['title'],
                'location' => $offer['location'],
                'duration' => $offer['duration'],
                'category_id' => $offer['category_id'],
                'picture' => Offer::THUMBNAILS_FOLDER . Offer::getDefaultThumbnailFileName(Category::find($offer['category_id'])->value),
                'description' => $offer['description'],
            ]);
        }

       //$offers = factory(App\Offer::class,5)->create();
    }
}
