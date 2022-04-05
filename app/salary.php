<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    public function getAll()
    {
        $salary = $this->get();
        return $salary;
    }
    public function getByUserId($id)
    {
        $salary = $this->where('user_id', '=', $id)->get();
        return $salary;
    }
    public function salaryUpdate($id)
    {
        $salary = $this->getByUserId($id);
        $salary->salary = $salary;
        $salary->update();
    }
}