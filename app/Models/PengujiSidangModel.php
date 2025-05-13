<?php 

namespace App\Models;

use CodeIgniter\Model;

class PengujiSidangModel extends Model 
{
    protected $table = 'penguji_sidang';
    protected $primaryKey = 'id_penguji';
    protected $allowedFields = [ 
        'peran'
    ];
}
?>