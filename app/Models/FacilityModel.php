<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'facility';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function createFa($data)
    {
        return $this->insert($data);
    }

    public function getFa()
    {
        return $this->orderBy($this->table . '.created_at', 'DESC')->findAll();
    }

    public function getFaById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function updateLabel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteFa($id)
    {
        return $this->delete($id);
    }
}
