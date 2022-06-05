<div {{$attributes->merge(['class' => "bg-gray-50 border border-gray-200 rounded p-6"])}}> {{--this enables us to add extra classes if needed. It will use these classes by default but it will also merge any other classes that we add.--}}
    {{$slot}}
</div>    