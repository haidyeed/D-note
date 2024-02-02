<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $notes = Note::paginate(10, ['*'], 'notepage');

        return response()->json([
            'success' => true,
            'message' => 'a list of all notes',
            'data' => $notes
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     */
    public function store(StoreNoteRequest $request)
    {
        $note = new Note;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->user_id = $request->user_id;

        $note->save();

        return response()->json([
            'success' => true,
            'message' => 'a new note has been added successfully',
            'data' => $note
        ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoteRequest  $request
     */
    public function update(UpdateNoteRequest $request,$id)
    {
        $note = Note::find($id);
        if($note){

            $data = $request->only(['title', 'content','user_id']);

            $note->fill($data)->save();

            return response()->json([
                'success' => true,
                'message' => 'note updated successfully',
                'data' => $note
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'this note is not found'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $note= Note::find($id);

       if($note){

        return response()->json([
            'success' => true,
            'message' => 'note',
            'data' => $note
        ], 200);

       }

       return response()->json([
        'success' => false,
        'message' => 'this note is not found',
       ], 404);

    }


    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        if ($note){
            if($note->delete()){

                return response()->json([
                    'success' => true,
                    'message' => 'note deleted successfully'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Bad request, this note is not deleted'
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'this note is not found'
        ], 404);
    }

}