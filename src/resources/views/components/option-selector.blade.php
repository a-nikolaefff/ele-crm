<div id="optionSelector" data-value="{{$parameterName}}">

    @if($allOptionsSelector)
        <a href="{{ $url }}" data-value="allOptionsSelection">
            <button type="button" class="btn btn-outline-primary mb-2 me-1">
                {{ $allOptionsSelector }}
            </button>
        </a>
    @endif

    @foreach($options as $option)
        <a href="{{ $url }}" data-value="{{ $option->{$passingProperty} }}">
            <button type="button" class="btn btn-outline-primary mb-2 me-1">
                {{ $option->{$displayingProperty} }}
            </button>
        </a>
    @endforeach

    @if($notSpecifiedOptionSelector)
        <a href="{{ $url }}" data-value="none">
            <button type="button" class="btn btn-outline-primary mb-2">
                {{ $notSpecifiedOptionSelector }}
            </button>
        </a>
    @endif

</div>
