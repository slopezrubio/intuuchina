<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Fee extends Model
{
    //
    protected $fillable = [
        'name', 'heading', 'type', 'value', 'unit', 'amount', 'jurisdiction', 'minimum'
    ];

    public function categories() {
        return $this->hasMany('App\Category');
    }

    public function feeType() {
        return $this->belongsTo('App\FeeType', 'type');
    }

    public function getTaxRate() {
        return __('taxes.'.$this->jurisdiction);
    }

    public function update(array $attributes = [], array $options = []) {
        $this->fill($attributes)->save($options);
    }

    public function displayPriceTag() {
        $tagPrice =  numfmt_format_currency(numfmt_create(Config::get('app.locale'), \NumberFormatter::CURRENCY), $this->amount, Config::get('services.stripe.cashier_currency'));

        if ($this->type == 2) {
            $tagPrice = __('content.per unit', ['unit' => $this->unit, 'price' => numfmt_format_currency(numfmt_create(Config::get('app.locale'), \NumberFormatter::CURRENCY), $this->amount, Config::get('services.stripe.cashier_currency'))]);
        }

        return $tagPrice;
    }

    /**
     * Sync the categories associated to the fee.
     *
     * @param $categories
     */
    public function syncCategories($categories = null) {
        foreach($this->feeType->programs as $program) {
            if ($categories === null) {
                foreach ($program->categories as $category) {
                    if (in_array($category->id, array_column(Category::getOptions($this->categories), 'value'))) {
                        $category->fee()->dissociate();
                        $category->save();
                    }
                }
            } elseif(count($categories) > 0) {
                foreach ($program->categories as $category) {
                    if (in_array($category->id, array_column(Category::getOptions($this->categories), 'value'))) {
                        if (!in_array($category->id, $categories)) {
                            $category->fee()->dissociate();
                            $category->save();
                        }
                    } else {
                        if (in_array($category->id, $categories)) {
                            $category->fee()->associate($this);
                            $category->save();
                        }
                    }
                }
            }
        }
    }
}
