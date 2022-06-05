@extends('layout')

@section('content')
@include('partials._hero') {{--getting from the partials folder.--}}
@include('partials._search')



<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

<h1>{{$heading}}</h1> <!--Using the blade file type we can echo out php in a similar way as ejs templating.-->


@unless(count($listings) == 0) <!--We can also use conditionals-->

  
@foreach($listings as $listing) <!--So now instead of typing tedious php tags, we can use @ symbol for any code logic.-->

    <x-listing-card : listing="$listing"/> {{--This is how we gain access to the component--}}


@endforeach

@else
<p>No Listings were found.</p>
@endunless

</div>

@endsection