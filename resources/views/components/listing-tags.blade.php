@props(['tagsCsv']) {{--we want to turn the property that will be going in this component into an array that we can loop through--}}

@php
 
    $tags = explode(',', $tagsCsv); //$tags is now an array of values.

@endphp

<ul class="flex">

    @foreach($tags as $tag)
        

    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a> {{--We also want to be able to clickon it and filter the posts by that tag, we can do this by giving the value as a query param--}}
    </li>

    @endforeach
 
</ul>