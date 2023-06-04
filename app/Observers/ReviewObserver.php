<?php

namespace App\Observers;

use App\Models\ReviewFood;
use App\Models\InforShop;

class ReviewObserver
{
    public function updated(ReviewFood $review)
    {
        $star_old = $review->getOriginal('star');
        $shop=InforShop::where('id_account', $review->food->id_shop)->firstOrFail();
        $shop->star = ($shop->star*$shop->number_review + $review->star - $star_old)/($shop->number_review);
        $shop->save();
    }

    public  function created(ReviewFood $review)
    {
        $shop=InforShop::where('id_account', $review->food->id_shop)->firstOrFail();  
        $shop->star = ($shop->star*$shop->number_review + $review->star)/($shop->number_review + 1);
        $shop->number_review = $shop->number_review + 1;
        $shop->save();
    }

    public function deleted(ReviewFood $review)
    {
        $shop=InforShop::where('id_account', $review->food->id_shop)->firstOrFail();
        $shop->star = ($shop->star*$shop->number_review - $review->star)/($shop->number_review - 1);
        $shop->number_review = $shop->number_review - 1;
    }
}
