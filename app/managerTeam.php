<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class managerTeam extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deleteByEmpID($id)
    {
        $this->where('employee_id', $id)
            ->delete();
    }
}