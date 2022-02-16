@include("open-admin-media::header")

    @if (!empty($list))
        <table class="table table-hover">
            <tbody>
            <tr>
                <th width="40px;">
                    <span class="file-select-all">
                    <input type="checkbox" class="form-check-input" value=""/>
                    </span>
                </th>
                <th>{{ trans('admin.name') }}</th>
                @if (!empty($select))
                    <th>{{ trans('admin.select') }}</th>
                @else
                    <th></th>
                @endif
                <th width="200px;">{{ trans('admin.time') }}</th>
                <th width="100px;">{{ trans('admin.size') }}</th>
            </tr>
            @foreach($list as $item)
            <tr>
                <td style="padding-top: 15px;">
                    <span class="file-select">
                    <input type="checkbox" class="form-check-input" value="{{ $item['name'] }}"/>
                    </span>
                </td>
                <td>
                    {!! $item['preview'] !!}

                    <a @if(!$item['isDir'])target="_blank"@endif href="{{ $item['link'] }}" class="file-name" title="{{ $item['name'] }}">
                        {{ $item['icon'] }} {{ basename($item['name']) }}
                    </a>

                </td>

                @if (!empty($select))
                    <td>
                        @if ($item['isDir'])
                            <span class="btn">&nbsp;</span>
                        @else
                            <a href="javascript:{{$fn}}('{{ $item['url'] }}','{{ $item['name'] }}');@if ($close) window.close();@endif" class="btn btn-primary">{{ trans('admin.select') }}</a>
                        @endif
                    </td>
                @else
                <td class="action-row">
                    <div class="btn-group btn-group-sm hide">
                        <a class="btn btn-light file-rename" data-bs-toggle="modal" data-bs-target="#moveModal" data-name="{{ $item['name'] }}"><i class="icon-edit"></i></a>
                        <a class="btn btn-light file-delete" data-path="{{ $item['name'] }}"><i class="icon-trash"></i></a>
                        @unless($item['isDir'])
                        <a target="_blank" href="{{ $item['download'] }}" class="btn btn-light"><i class="icon-download"></i></a>
                        @endunless
                        <a class="btn btn-light" data-bs-toggle="modal" data-bs-target="#urlModal" data-url="{{ $item['url'] }}"><i class="icon-link"></i></a>
                    </div>
                </td>
                 @endif

                <td>{{ $item['time'] }}&nbsp;</td>
                <td>{{ $item['size'] }}&nbsp;</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@include("open-admin-media::footer")
@include("open-admin-media::_shared")