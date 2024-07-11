<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Storage;
use App\Models\users;
use Illuminate\Database\Eloquent\Model;



class PostsController extends Controller
{
    public static function all()
    {
        return Posts::All();
    }




    public function explore()
    {
        return view('user.explore');
    }

    public function message()
    {
        return view('user.message');
    }

    public function createPost()
    {
        return view('user.createPost');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,jpeg,svg,webp|max:10000',
            'caption' => 'required|string',
            'id_user' => 'required|integer',
            'location' => 'nullable|string',
            'categorie' => 'nullable|string'
        ]);

        $file = $request->file('file');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExt = $file->getClientOriginalExtension();
        $fileHash = md5_file($file->getRealPath());
        $fileDestination = 'public/posts/' . $fileName . '.' . $fileExt;

        $isDuplicate = false;
        foreach (Storage::files('public/posts') as $existingFile) {
            if (md5_file(storage_path('app/' . $existingFile)) === $fileHash) {
                $isDuplicate = true;
                break;
            }
        }

        if (!$isDuplicate) {
            if ($file->storeAs('public/posts', $fileName . '.' . $fileExt)) {
                $data = [
                    'caption' => $request->caption,
                    'user_id' => $request->id_user,
                    'image' => $fileName . '.' . $fileExt,
                    'location' => $request->location,
                    'categorie' => $request->categorie
                ];

                if (Posts::create($data)) {
                    return redirect()->route('createPost')->with('success', 'Post created successfully.');
                } else {
                    return redirect()->back()->with('error', 'Data save error.');
                }
            } else {
                return redirect()->back()->with('error', 'Failed to move uploaded file.');
            }
        } else {
            $data = [
                'caption' => $request->caption,
                'user_id' => $request->id_user,
                'image' => $fileName . '.' . $fileExt,
                'location' => $request->location,
                'categorie' => $request->categorie
            ];

            if (Posts::create($data)) {
                return redirect()->route('createPost')->with('success', 'Post created successfully.');
            } else {
                return redirect()->back()->with('error', 'Data save error.');
            }
        }
    }


    public function edit($id)
    {
        // Your code for the edit method
    }

    public function update(Request $request, $id)
    {
        // Your code for the update method
    }

    public function viewPosts()
    {
        $posts = Posts::orderBy('created_at', 'desc')->get(); // Fetch posts from database, ordered by creation date

        return view('user.viewPosts', ['posts' => $posts]);
    }
    public static function infopost($id, $usr_id)
    {
        $post = Posts::findOrFail($id);
        $user = users::find($usr_id);
        return ['post' => $post, 'user' => $user];
    }
    public static function deletePost(Request $request, $id)
    {
        $Post = Posts::findOrFail($id);
        $Post->delete();
        return redirect('/admin/dashboard')->with('success', 'deleted successfully');
    }
    public function deletePst(Request $request, $id)
    {
        $Post = Posts::findOrFail($id);
        $Post->delete();
        return redirect('userPage')->with('success', 'deleted successfully');
    }
}
