<?php
namespace App\Repositories\Account;

use App\Repositories\BaseRepository;

class AccountRepository extends BaseRepository implements IAccountFoodRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Account::class;
    }
}
