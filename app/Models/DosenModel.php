<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model 
{
    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    protected $allowedFields = [
        'nidn',
        'nama_dosen',
        'program_studi',
        'email'
    ];
}
?>