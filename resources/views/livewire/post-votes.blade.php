<div class="col-1 text-center">
    <div>
        <a wire:click.prevent="vote(1)" href="#" title="Upvote"><i class="fa fa-2x fa-sort-asc" aria-hidden="true"></i></a>
    </div>
    <b style="font-size: 24px; font-weight: bold">{{ $sumVotes }}</b>
    <div>
        <a wire:click.prevent="vote(-1)" href="#" title="Downvote"><i class="fa fa-2x fa-sort-desc" aria-hidden="true"></i></a>
    </div>
</div>