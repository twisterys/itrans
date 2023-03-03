<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisiteTechTaco;
use App\Taco;
use App\VisiteTechniqueTaco;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VisiteTechnqueTacoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Taco $taco)
    {
        //return VisiteTechniqueTaco::with('taco:id')->where('taco_id',$taco->id)->get();
        if ($request->ajax()) {
            $data = VisiteTechniqueTaco::with('taco:id')->where('taco_id',$taco->id)->get();
        
            $table = Datatables::of($data);           

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : '';
            });
            $table->editColumn('date_last_visit', function ($row) {
                return $row->date_last_visit ? $row->date_last_visit : '';
            });
            $table->editColumn('date_next_visit', function ($row) {
                return $row->date_next_visit ? $row->date_next_visit : '';
            });

            $table->editColumn('actions', function ($row) {
                $editLink = route('taco.visiteTechnique.edit',[$row->taco->id,$row->id]);
                $donwload = route('taco.visiteTech.download',$row->id);
                
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteVisiteTech('.$row->taco->id.','.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                $btn .= '<a href="'.$donwload.'" class="btn btn-secondary btn-sm mr-1">Télécharger</a>';
                return $btn;
            });
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('visite_tech_taco.index',compact('taco'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Taco $taco)
    {
        return view('visite_tech_taco.create',compact('taco'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisiteTechTaco $request,Taco $taco)
    {
        $VTT = VisiteTechniqueTaco::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $VTT->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('VisiteTechniqueTaco_file');
        }

        return redirect()->route('taco.visiteTechnique.index',$request->taco_id)->with('message','Visite technuque de dique est ajouté avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Taco $taco,VisiteTechniqueTaco $visiteTechnique)
    {
        return view('visite_tech_taco.edit',compact('taco','visiteTechnique'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVisiteTechTaco $request, Taco $taco,VisiteTechniqueTaco $visiteTechnique)
    {
        $visiteTechnique->update($request->all());

        if (count($visiteTechnique->VisiteTechniqueTaco_file) > 0) {
            foreach ($visiteTechnique->VisiteTechniqueTaco_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }

        $media = $visiteTechnique->VisiteTechniqueTaco_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $visiteTechnique->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('VisiteTechniqueTaco_file');
            }
        }
        
        return back()->with('message','Taco est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($taco,$techniqueVisite)
    {
        $v = VisiteTechniqueTaco::findOrFail($techniqueVisite)->delete();
        if($v){
            return response()->json([
                'message' => 'Visite technique pour taco est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs, refaire cette action aprés",
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

    public function dowload($id){
        $visiteTech = VisiteTechniqueTaco::with('media')->whereId($id)->first();
        if($visiteTech->VisiteTechniqueTaco_file == '[]'){
            return back()->with('warning',"Vous n'avez pas encore ajouté des fichiers");
        }
        else{
            foreach ($visiteTech->VisiteTechniqueTaco_file as $value) {
                return $value;
            }
        }
        
    }

    
}
