<?php

namespace App\Http\Controllers;

use App\Models\BoardGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BoardGameController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $boardGames = BoardGame::all();
        return response()->json(['data' => $boardGames]);
    }

    public function create()
    {
        return view('boardgamesadd');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), $this->validationRules());
    
        if ($validator->fails()) {
            return redirect()->route('boardgames.add')->withErrors($validator)->withInput();
        }
    
        // Handle image upload
        $filename = $this->handleImage($request);

        // Create a new board game with the validated data and the uploaded image filename
        $boardGame = BoardGame::create(array_merge($request->all(), ['image' => $filename]));

        // Redirect back to the form view with a success message
        return redirect()->route('boardgames.add')->with('success', 'Board game added successfully');
    }

    
    // Display the specified resource.
    public function show($id)
    {
        $boardGame = BoardGame::findOrFail($id);
        return response()->json(['data' => $boardGame]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $boardGame = BoardGame::findOrFail($id);
    
        $validator = Validator::make($request->all(), $this->validationRules());
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Handle image upload
        $filename = $this->handleImage($request, $boardGame);

        // Update the board game with the validated data and the uploaded image filename
        $boardGame->update(array_merge($request->all(), ['image' => $filename]));

        // Respond with JSON data after successful update
        return response()->json(['data' => $boardGame], 200);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $boardGame = BoardGame::findOrFail($id);

        // Delete the associated image
        if ($boardGame->image) {
            Storage::delete($boardGame->image);
        }

        $boardGame->delete();
        return response()->json(['message' => 'Board game deleted successfully'], 204);
    }

    private function validationRules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'nullable',
            'rules' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'min_players' => 'required|integer',
            'max_players' => 'required|integer',
            'min_playtime' => 'required|integer',
            'max_playtime' => 'required|integer',
            'year_published' => 'required|integer',
            'designer' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'difficulty_level' => 'nullable|integer|min:1|max:5',
            'game_type' => 'nullable|string|max:255',
            'mechanics' => 'nullable|string|max:255',
            'is_expansion' => 'nullable|boolean',
            'release_date' => 'nullable|date',
            'language_dependency' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }

    private function handleImage(Request $request, BoardGame $boardGame = null)
    {
        if ($request->hasFile('image')) {
            // Delete previous image if updating
            if ($boardGame && $boardGame->image) {
                Storage::delete($boardGame->image);
            }

            // Store and return the new image filename
            return $request->file('image')->store('board-games');
        }

        // If no new image is uploaded, return the existing image filename
        return $boardGame ? $boardGame->image : null;
    }
}
