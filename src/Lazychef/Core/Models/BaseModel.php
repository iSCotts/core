<?php namespace Lazychef\Core\Models;

class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    public function getConnection()
    {
        return static::resolveConnection('lazychef');
    }
}
