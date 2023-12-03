<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Hadith;
use Illuminate\Support\Facades\Request;

class CommentController extends Controller
{
    public function hadithsWithUnverifiedComments(Request $request, $offset = 0, $limit = 10)
    {
        $hadiths = Hadith::query()
            ->select(
                '_id',
                'title',
            )
            ->whereHas('comments', function ($q) {
                $q->whereNull('verified_at');
            })
            ->paginate()
            ->withQueryString();

        return view('dashboard.comments.hadith_list', compact('hadiths'));
    }

    public function hadithWithComments(Hadith $hadith)
    {
        return view('dashboard.comments.hadith_comments', compact('hadith'));

    }

    public function verify(Comment $comment): \Illuminate\Http\Response
    {
        if (! $comment->verified_at) {
            $comment->update([
                'verified_at' => now(),
                'verified_by_user_id' => auth()->id(),
            ]);
        }

        return response()->noContent();
    }

    public function destroy(Comment $comment): \Illuminate\Http\Response
    {
        $comment->delete();

        return response()->noContent();
    }
}
