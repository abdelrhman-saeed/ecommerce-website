<?php

namespace App\Http\Controllers\Dashboard\Resources;

use App\Http\Controllers\Controller;
use App\Models\Notebook;
use App\Models\NotebookPictures;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.dashboard.index', [
            'notebooks' => Notebook::where('notebook_type', $request->type ?? 'notebook')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.create-notebook');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'notebook_type' => 'required|in:notebook,todo,planner',
            'price' => 'required|numeric|between:0,9999.99',
            'discount' => 'nullable|numeric|between:0,100',
            'quantity' => 'nullable|numeric:min:0',
            'page_count' => 'nullable|numeric',
            'page_weight' => 'nullable|numeric|between:0,10000',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'main_picture' => 'required'
        ]);

        $request->file('main_picture')->storeAs(
            'public/notebook_pictures', $file_name = $request->file('main_picture')->hashName()
        );

        $notebook = $request->all();

        $notebook['main_picture'] = 'notebook_pictures/'. $file_name;
        $notebook = Notebook::create($notebook);

        if ($request->hasFile('other_pictures'))
        {
            $otherPictures = [];
            foreach($request->file('other_pictures') as $otherPicture)
            {
                $otherPicture->storeAs('public/notebook_pictures', $file_name = $otherPicture->hashName());

                $otherPictures[] = [
                    'picture_path' => 'storage/notebook_pictures/'. $file_name,
                    'notebook_id' => $notebook->id
                ];
            }
            NotebookPictures::upsert($otherPictures, ['id']);
        }

        return redirect('dashboard/notebooks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function show(Notebook $notebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Notebook $notebook)
    {
        return view('admin.dashboard.edit-notebook', ['notebook' => $notebook]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notebook $notebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notebook $notebook)
    {
        $notebook->delete();
        return redirect('dashboard/notebooks');
    }
}
