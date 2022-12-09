<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Services\PostService;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Storage;
use Image;

class ProfileController extends Controller
{
    private ProfileService $service;

    public function __construct()
    {
        $this->service = new ProfileService();
    }

    public function index()
    {
        # code...
    }

    public function show(Profile $profile)
    {
        $posts = (new PostService)->paginated(query: [
            'user_id' => auth()->id()
        ]);

        return view('profile.show', [
            'profile' => $profile,
            'posts' => $posts
        ]);
    }

    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);

        return view('profile.edit', compact('profile'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $data = $request->validated();

        $this->service->update(
            $profile,
            collect($data)
                ->except(['name'])
                ->all(),
            $request
        );

        return redirect()->route('profile.show', $profile);
    }

    public function deletePhoto(Profile $profile)
    {
        $this->authorize('update', $profile);

        Storage::delete('photo' . $profile->photo);

        $profile->update(['photo' => null]);

        return back()
            ->with('flag', 'Foto excluida com sucesso!');
    }

    public function follow(Profile $profile)
    {
        $profile->user->followers()->toggle(auth()->id());

        return back();
    }
}
