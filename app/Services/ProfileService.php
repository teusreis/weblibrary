<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ProfileService
{
    public function update(int | Profile $id, array $data, Request $request)
    {
        $profile = is_int($id)
            ? $this->findById($id)
            : $id;

        if ($request->file('photo')) {
            $data['photo'] = $request->file('photo')->store('public/avatars');

            Image::make(storage_path('app/' . $data['photo']))
                ->resize(200, 200)
                ->save();

            $data['photo'] = str_replace('public/', '', $data['photo']);

            if ($profile->photo) {
                Storage::delete('photo' . $profile->photo);
            }
        } else {
            unset($data['photo']);
        }

        return $profile->update($data);
    }

    public function findById(int $id, array $with = []): Profile
    {
        return Profile::query()
            ->where('id', $id)
            ->with($with)
            ->fist($with);
    }
}
