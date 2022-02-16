<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-header navbar">

                <div class="btn-group me-2">
                    <a href="" type="button" class="btn btn-light btn media-reload" title="Refresh">
                        <i class="icon-sync-alt"></i>
                    </a>
                    <a type="button" class="btn btn-light btn file-delete-multiple" title="Delete">
                        <i class="icon-trash"></i>
                    </a>
                </div>
                <!-- /.btn-group -->
                <label class="btn btn-light btn me-2"{{-- data-toggle="modal" data-target="#uploadModal"--}}>
                    <i class="icon-upload"></i>&nbsp;&nbsp;{{ __('admin.upload') }}
                    <form action="{{ $url['upload'] }}" method="post" class="file-upload-form" enctype="multipart/form-data" pjax-container>
                        <input type="file" name="files[]" class="d-none file-upload" multiple>
                        <input type="hidden" name="dir" value="{{ $url['path'] }}" />
                        {{ csrf_field() }}
                    </form>
                </label>

                <!-- /.btn-group -->
                <a class="btn btn-light btn me-2" data-bs-toggle="modal" data-bs-target="#newFolderModal">
                    <i class="icon-folder"></i>&nbsp;&nbsp;{{ __('admin.new_folder') }}
                </a>

                <div class="btn-group me-2">
                    <a href="{{ route('media-index', ['path' => $url['path'], 'view' => 'table', 'select' => $select, 'fn' => $fn]) }}" class="btn @if($view == "table")btn-primary @else btn-light @endif"><i class="icon-list"></i></a>
                    <a href="{{ route('media-index', ['path' => $url['path'], 'view' => 'list', 'select' => $select, 'fn' => $fn]) }}" class="btn @if($view == "list")btn-primary @else btn-light @endif"><i class="icon-th"></i></a>
                </div>

                {{--<form action="{{ $url['index'] }}" method="get" pjax-container>--}}
                <div class="ms-auto input-group input-group-sm pull-right goto-url" style="width: 250px;">
                    <input type="text" name="path" class="form-control pull-right" value="{{ '/'.trim($url['path'], '/') }}">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-light"><i class="icon-arrow-right"></i></button>
                    </div>
                </div>
            {{--</form>--}}

            <!-- /.mailcard-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-body">
                <nav class="breadcrumb-nav">
                    <ol class="breadcrumb" style="margin: -10px 0 6px 10px;">

                        <li class="breadcrumb-item"><a href="{{ route('media-index') }}?select={{$select}}&fn={{$fn}}"><i class="icon-th-large"></i> </a></li>

                        @foreach($nav as $item)
                            <li class="breadcrumb-item"><a href="{{ $item['url'] }}&view={{$view}}&select={{$select}}&fn={{$fn}}"> {{ $item['name'] }}</a></li>
                        @endforeach
                    </ol>
                </nav>