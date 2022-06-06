@props(['listing'])  {{--components can take in props. in this case the props will come from the parent listings.blade.php--}}

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{asset('images/no-image.png')}}" {{--Not sure what this function does to be honest--}}
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/listing/{{$listing->id}}">{{$listing->title}}</a> {{--when using eloquent models. we can actually use the arrow syntax--}}
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            

            <x-listing-tags :tagsCsv="$listing->tags" />
            {{-- <ul class="flex">
                <li
                    class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                >
                    <a href="#">Laravel</a>
                </li>
                <li
                    class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                >
                    <a href="#">API</a>
                </li>
                <li
                    class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                >
                    <a href="#">Backend</a>
                </li>
                <li
                    class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                >
                    <a href="#">Vue</a>
                </li>
            </ul> --}}

            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>
   