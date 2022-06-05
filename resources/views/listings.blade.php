<h1>Listings</h1>

<h3>{{$heading}}</h3> <!--Using the blade file type we can echo out php in a similar way as ejs templating.-->


@unless(count($listings) == 0) <!--We can also use conditionals-->

  
@foreach($listings as $listing) <!--So now instead of typing tedious php tags, we can use @ symbol for any code logic.-->

    <h2>
        <a href="/listings/listing/{{$listing['id']}}">
            {{$listing['title']}}
        </a>
    </h2>
    <p>
        {{$listing['description']}}
    </p>
   
@endforeach

@else
<p>No Listings were found.</p>
@endunless


