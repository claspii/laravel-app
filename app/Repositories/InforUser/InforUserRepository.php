<?php
namespace App\Repositories\InforUser;

use App\Repositories\BaseRepository;

class InforUserRepository extends BaseRepository implements IInforUserRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\InforUser::class;
    }
}
