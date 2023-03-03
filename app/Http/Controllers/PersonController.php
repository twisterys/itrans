<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Http\Requests\PersonStoreRequest;
use App\Person;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersonController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Person::class);
        if ($request->ajax()) {
            $data = Person::latest()->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $showLink = route('person.show',$row->id);
                $editLink = route('person.edit',$row->id);
                $deleteLink = 'deletePerson('.$row->id.')';
                return view('partials.personActions',compact('showLink','editLink','deleteLink'));

                $btn = '<a href="'.$showLink.'" class="btn btn-info btn-sm mr-1">Afficher</a>';
                $btn .= '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button type="button" class="btn btn-danger btn-sm mr-1" onclick="deletePerson('.$row->id.')">Supprimer</button>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('matricule', function ($row) {
                return $row->matricule ? $row->matricule : '';
            });
            $table->editColumn('nom', function ($row) {
                return $row->nom ? $row->nom : '';
            });
            $table->editColumn('prenom', function ($row) {
                return $row->prenom ? $row->prenom : '';
            });
            $table->editColumn('fonction', function ($row) {
                return $row->fonction ? $row->fonction : '';
            });
            $table->editColumn('section', function ($row) {
                return $row->section ? $row->section : '';
            });
            $table->editColumn('date_naiss', function ($row) {
                return $row->date_naiss ? $row->date_naiss : '';
            });
            $table->editColumn('cin', function ($row) {
                return $row->cin ? $row->cin : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? '<span class="badge bg-success text-white">'.$row->type.'</span>' : '';
            });
            $table->editColumn('nationalite', function ($row) {
                return $row->nationalite ? $row->nationalite : '';
            });
            $table->editColumn('tele', function ($row) {
                return $row->tele ? $row->tele : '';
            });


            $table->rawColumns(['type','actions', 'placeholder']);

            return $table->make(true);
        }

        return view('person.index');

    }

    public function show(Person $person){
        $this->authorize('view',Person::class);
        $nbImport = 0;
        $nbExport = 0;
        $nbNational = 0;

        $nbImport = $person->dossier()->where('type','import')->count();
        $nbExport = $person->dossier()->where('type','export')->count();
        $nbNational = $person->dossier()->where('type','national')->count();


        return view('person.show',compact('person','nbImport','nbExport','nbNational'));
    }
    public function create(){
        $this->authorize('create',Person::class);
        return view('person.create');
    }

    /**
     * @param \App\Http\Requests\PersonStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonStoreRequest $request)
    {
        $this->authorize('create',Person::class);
        $person = Person::create($request->all());
        $person->update([
            'type' => 'interne'
        ]);

        if($request->input('file')){
            $person->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('person_file');
        }



        return redirect()->route('person.index')->with('message','Personne ajouté avec succés');
    }

    public function edit(Person $person){
        $this->authorize('update',Person::class);
        return view('person.edit',compact('person'));
    }

    public function update(PersonStoreRequest $request,Person $person){
        $this->authorize('update',Person::class);
        //return $request->all();
        $person->update($request->all());
        if($request->input('file')){
            if (count($person->person_file) > 0) {
            foreach ($person->person_file as $media) {
//                if (!in_array($media->file_name, $request->input('file'))) {
                if ($media->file_name != $request->input('file')) {
                    $media->delete();
                }
            }
            }
            $media = $person->person_file->pluck('file_name')->toArray();

            if (count($media) === 0 || !in_array($request->input('file'), $media)) {
                $person->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('person_file');
            }
        }

        return back()->with('message','Personne modifié avec succés');
    }

    public function destroy($person){
        $this->authorize('delete',Person::class);
        $v = Person::findOrFail($person)->delete();
        if($v){
            return response()->json([
                'message' => 'Ce Personne est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est passé refaire cette action aprés",
                'success' => false
            ]);
        }
    }

    public function addExternal(Request $request){
        $person = new Person();
        $person->nom = $request->nom;
        $person->prenom = $request->prenom;
        $person->matricule = $request->matricule;
        $person->cin = $request->cin;
        $person->type = 'externe';
        $person->fonction = 'chauffeur';
        $person->save();

        return response()->json([
            'data' => '<option value="'.$person->id.'" selected>'.$person->nom.' '.$person->prenom.'('.$person->cin.')'.'</option>'
        ]);
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
                    request()->input('width', 1),
                    request()->input('height', 1)
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
        return $name;

        // return response()->json([

        //     'original_name' => $file->getClientOriginalName(),
        // ]);
    }
}
