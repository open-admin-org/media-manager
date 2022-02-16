@include("open-admin-media::header")

    <ul class="files list clearfix">

        @if (empty($list))
            <li style="height: 200px;border: none;"></li>
        @else
            @foreach($list as $item)
            <li>
                <span class="file-select">
                    <input type="checkbox" class="form-check-input" value="{{ $item['name'] }}"/>
                </span>

                {!! $item['preview'] !!}

                <div class="file-info">
                    <a @if(!$item['isDir'])target="_blank"@endif href="{{ $item['link'] }}" class="file-name" title="{{ $item['name'] }}">
                        {{ $item['icon'] }} {{ basename($item['name']) }}
                    </a>
                    <span class="file-size">
                      {{ $item['size'] }}&nbsp;
                    </span>

                    @if (!empty($select))
                        @if ($item['isDir'])
                            <span class="btn">&nbsp;</span>
                        @else
                            <a href="javascript:{{$fn}}('{{ $item['url'] }}','{{ $item['name'] }}');@if ($close) window.close();@endif" class="btn btn-primary">{{ trans('admin.select') }}</a>
                        @endif
                    @else
                    <div class="btn-group btn-group-sm float-end">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="dropdown-item file-rename" data-bs-toggle="modal" data-bs-target="#moveModal" data-name="{{ $item['name'] }}">Rename & Move</a></li>
                            <li><a href="#" class="dropdown-item file-delete" data-path="{{ $item['name'] }}">Delete</a></li>
                            @unless($item['isDir'])
                            <li><a target="_blank" class="dropdown-item" href="{{ $item['download'] }}">Download</a></li>
                            @endunless
                            <li class="divider"></li>
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#urlModal" data-url="{{ $item['url'] }}">Url</a></li>
                        </ul>
                    </div>
                    @endif

                </div>
            </li>
            @endforeach
        @endif
    </ul>
@include("open-admin-media::footer")
@include("open-admin-media::_shared")


