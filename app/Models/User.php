<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    const SALT = "g";

    protected $fillable = [
        'name',
        'surname',
        'login',
        'password',
        'key'
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setKeyAttribute($key)
    {
        $this->attributes['key'] = Hash::make($key . self::SALT);
    }

    static function getIdByKey($key)
    {
        return self::query()->where('key', $key)->select('id')->get()[0]->id;
    }
}
