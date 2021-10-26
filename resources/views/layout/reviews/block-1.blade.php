<div class="main__rev_cont01 cont">

    @foreach(range(1,5) as $i)
        @php
            $description = $i === 3
                            ?trans('blocks/layout/reviews/block-1.description_'.$i, ['name' => trans('project_defs.name')])
                            :trans('blocks/layout/reviews/block-1.description_'.$i)
        @endphp
        @include('layout.reviews.review',
            [
                'title' => trans('blocks/layout/reviews/block-1.title_'.$i),
                'description' => $description
            ])
    @endforeach


</div>
