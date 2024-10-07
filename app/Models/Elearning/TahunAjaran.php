<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = "tahun_ajaran";
    protected $primaryKey = "id_tahun_ajaran";
    protected $connection = "elearning";
    public $timestamps = false;

    public function kelas_mapel() {
        return $this->hasMany(KelasMapel::class, 'tahun_ajaran_id', 'id_tahun_ajaran');
    }
}
