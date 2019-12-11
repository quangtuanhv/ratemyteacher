<?php

namespace App\Repositories\Eloquent;

use App\Models\Center;
use App\Repositories\Contracts\CenterInterface;

class CenterRepository extends BaseRepository implements CenterInterface
{
    public function model()
    {
        return Center::class;
    }

    public function create($inputs){
        if (is_null($inputs) || !is_array($inputs)) {
            throw new UnknowException('Inputs is null or not an array');
        }
        $data = [
            'name' => $inputs['name'],
            'address' => $inputs['address'],
            'website' => empty($inputs['website']) ? null : $inputs['website'],
            'description' => empty($inputs['description']) ? null : $inputs['description'],
            'phone' => empty($inputs['phone']) ? null : $inputs['phone'],
            'image' => empty($inputs['image']) ? config('settings.default_avatar') : $inputs['image'],
            'email' => empty($inputs['email']) ? null : $inputs['email'],
            'user_id' =>  $inputs['user_id'],
        ];
        $center = parent::create($data);

        if (!$center) {
            throw new NotFoundException('Error create center');
        }
        return "You have created center successfully.";
    }
}
