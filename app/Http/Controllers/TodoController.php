<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return response([
            'todos' => $todos
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|alpha_num',
                'description' => 'required|alpha_num'

                ]);
            $user = Auth::user();
            if($user){
               $todo = $user->create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => 'Pending'
                ]);
                return $this->customSuccessResponse([
                    'todo'=>$todo,
                    'message'=> 'Todo added successfully'
                    ],200);
            }
            return $this->customFailureResponse('Unauthorized', 401);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->customFailureResponse('Internal Server Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
