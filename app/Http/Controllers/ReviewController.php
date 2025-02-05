<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // Get all reviews
    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            'status' => 200,
            'message' => 'Reviews retrieved successfully.',
            'data' => $reviews
        ], 200);
    }

    // Add a new review
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'required|string'
        ]);

        $review = Review::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Review created successfully.',
            'data' => $review
        ], 201);
    }

    // Get a single review
    public function show($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Review retrieved successfully.',
            'data' => $review
        ], 200);
    }

    // Update a review
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'rating' => 'integer',
            'comment' => 'string'
        ]);

        $review->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Review updated successfully.',
            'data' => $review
        ], 200);
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
                'data' => null
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Review deleted successfully.',
            'data' => $review
        ], 200);
    }
}