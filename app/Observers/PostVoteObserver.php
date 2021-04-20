<?php

namespace App\Observers;

use App\Models\PostVote;

class PostVoteObserver
{
    /**
     * Handle the PostVote "created" event.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return void
     */
    public function created(PostVote $postVote)
    {
        $postVote->post->increment('votes', $postVote->vote);
    }

    /**
     * Handle the PostVote "updated" event.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return void
     */
    public function updated(PostVote $postVote)
    {
        //
    }

    /**
     * Handle the PostVote "deleted" event.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return void
     */
    public function deleted(PostVote $postVote)
    {
        //
    }

    /**
     * Handle the PostVote "restored" event.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return void
     */
    public function restored(PostVote $postVote)
    {
        //
    }

    /**
     * Handle the PostVote "force deleted" event.
     *
     * @param  \App\Models\PostVote  $postVote
     * @return void
     */
    public function forceDeleted(PostVote $postVote)
    {
        //
    }
}
