<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
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
        $user = Auth::user();
        // dd($user);
        $todos = $user->todos()->latest()->get();
        return response([
            'todos' => $todos
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request);
            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string'

                ]);
            $user = Auth::user();
            if($user){
               $todo = $user->todos()->create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => 'Pending'
                ]);
                return $this->customSuccessResponse([
                    'todo'=>$todo,
                    'message'=> 'Todo added successfully'
                    ]);
            }
            return $this->customFailureResponse('Unauthorized', 401);
        } catch (\Throwable $th) {
            // throw $th;
            return $this->customFailureResponse('Internal Server Error', 500);
        }
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
