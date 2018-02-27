<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stack Builders Code Challenge</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body style="font-family: 'Raleway', sans-serif">
        <div class="mx-auto p-3 max-w-xl text-sm text-center">
            @if (request()->filter)
            <a href="{{ url()->current() }}" class="inline-block mx-2 p-3 rounded bg-grey-darker text-grey-light no-underline capitalize">All entries</a> 
            @endif
            @if (request()->filter !== 'title_more_5_words_and_sort_by_comments')
            <a href="{{ url()->current() . '?filter=title_more_5_words_and_sort_by_comments' }}" class="inline-block mx-2 p-3 rounded bg-grey-darker text-grey-light no-underline capitalize">title more 5 words and sort by comments</a>
            @endif
            @if (request()->filter !== 'title_less_or_equal_5_words_and_sort_by_points')
            <a href="{{ url()->current() . '?filter=title_less_or_equal_5_words_and_sort_by_points' }}" class="inline-block mx-2 p-3 rounded bg-grey-darker text-grey-light no-underline capitalize">title less or equal 5 words and sort by points</a>
            @endif
        </div>
        <div class="mx-auto max-w-xl text-sm">
            <div class="flex font-bold uppercase tracking-wide">
                <div class="p-3 w-24">RANK</div>
                <div class="p-3 w-full">TITLE</div>
                <div class="p-3 w-48">POINTS</div>
                <div class="p-3 w-48">COMMENTS</div>
            </div>
            @foreach ($entries as $entry)
            <div class="flex">
                <div class="p-3 w-24">{{ $entry->get('rank') }}</div>
                <div class="p-3 w-full">{{ $entry->get('title') }}</div>
                <div class="p-3 w-48">{{ $entry->get('points') }} points</div>
                <div class="p-3 w-48">{{ $entry->get('comments') }} comments</div>
            </div>
            @endforeach
        </div>
    </body>
</html>
