<?php

namespace App\Http\Controllers;

use App\AssuranceTravail;
use App\Http\Requests\StoreAssuranceTravailRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssuranceTravailController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AssuranceTravail::all();
        
            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editLink = route('assuranceTravail.edit',$row->id);
                $deleteLink = route('assuranceTravail.destroy',$row->id);
                
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteAssuranceTravail('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('expiration', function ($row) {
                return $row->expiration ? $row->expiration : '';
            });
            $table->addColumn('assureur', function ($row) {
                return $row->assureur ? $row->assureur : '';
            });
            $table->addColumn('police', function ($row) {
                return $row->police ? $row->police : '';
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('assurance_travail.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assurance_travail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssuranceTravailRequest $request)
    {
        $ass = AssuranceTravail::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $ass->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('assurance_travail_file');
        }

        return redirect()->route('assuranceTravail.index')->with('message','Assurance est crée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssuranceTravail  $assuranceTravail
     * @return \Illuminate\Http\Response
     */
    public function show(AssuranceTravail $assuranceTravail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssuranceTravail  $assuranceTravail
     * @return \Illuminate\Http\Response
     */
    public function edit(AssuranceTravail $assuranceTravail)
    {
        return view('assurance_travail.edit',compact('assuranceTravail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssuranceTravail  $assuranceTravail
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAssuranceTravailRequest $request, AssuranceTravail $assuranceTravail)
    {
        $assuranceTravail->update($request->all());

        if (count($assuranceTravail->assurance_travail_file) > 0) {
            foreach ($assuranceTravail->assurance_travail_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assuranceTravail->assurance_travail_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assuranceTravail->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('assurance_travail_file');
            }
        }

        return redirect()->route('assuranceTravail.index')->with('message','Assurance est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssuranceTravail  $assuranceTravail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssuranceTravail $assuranceTravail)
    {
        $v = $assuranceTravail->delete();
        if($v){
            return response()->json([
                'message' => 'Assurance est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est passé",
                'success' => false
            ]);
        }
    }

    public function storeMedia(Request $request)
    {

// Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

// If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp'.DIRECTORY_SEPARATOR.'uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        $name = $file->getClientOriginalName();
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
