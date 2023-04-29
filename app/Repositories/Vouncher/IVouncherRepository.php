<?php
namespace App\Repositories\Vouncher;

use App\Repositories\BaseRepository;

class VouncherRepository extends BaseRepository implements IVouncherRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Vouncher::class;
    }
}
