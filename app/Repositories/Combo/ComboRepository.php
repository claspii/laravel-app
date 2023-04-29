<?php
namespace App\Repositories\Combo;

use App\Repositories\BaseRepository;

class ComboRepository extends BaseRepository implements IComboRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Combo::class;
    }
}
