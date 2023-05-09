<?php

namespace App\Observers;

use App\Models\ReviewFood;
use App\Models\InforShop;

class ReviewObserver
{
    public function udating(ReviewFood $review){
        $review->star_old = $review->star;
    }
    public function updated(ReviewFood $review)
    {
        $shop=InforShop::where('id_account', $review->id_shop)->firstOrFail();
        $shop->update('star', ($shop->star*$shop->number_review + $review->star - $review->star_old)/($shop->number_review));
    }

    public  function created(ReviewFood $review)
    {
        $shop=InforShop::where('id_account', $review->id_shop)->firstOrFail();
        $shop->update('star', ($shop->star*$shop->number_review + $review->star)/($shop->number_review + 1));
    }

    public function deleted(ReviewFood $review)
    {
        $shop=InforShop::where('id_account', $review->id_shop)->firstOrFail();
        $shop->update('star', ($shop->star*$shop->number_review - $review->star)/($shop->number_review - 1));
    }
}
