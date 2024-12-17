<div
    class="mx-auto w-full py-4 sm:py-6 md:max-w-3xl lg:max-w-[40rem] lg:py-8 xl:max-w-[48rem]"
>
    <div class="prose max-w-none prose-h2:mt-6">
        @foreach ($this->landings as $value)
            <div id="{{ $value->slug }}">
                {!! $value->content !!}
            </div>
        @endforeach
    </div>
</div>
