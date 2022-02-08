
@if (isset($item['role']) && $item['role'] == auth()->user()->roles()->first()->slug)

    <li @isset($item['id']) id="{{ $item['id'] }}" @endisset
        @if ($item["url"] == "/checkin" && auth()->user()->clinic->code == "aodonto2")
            class="nav-item d-none"
        @else
            class="nav-item"
        @endif
    >

        <a class="nav-link py-3 {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
            href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
            {!! $item['data-compiled'] ?? '' !!}>

            <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
                isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
            }}"></i>

            <p>
                {{ $item['text'] }}

                @isset($item['label'])
                    <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                        {{ $item['label'] }}
                    </span>
                @endisset
            </p>

        </a>

    </li>

@endif
