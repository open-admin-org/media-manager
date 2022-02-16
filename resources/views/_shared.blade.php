<style>

    .files > li {
        float: left;
        width: 150px;
        border: 1px solid #eee;
        margin-bottom: 10px;
        margin-right: 10px;
        position: relative;
    }

    .files > li > .file-select {
        position: absolute;
        top: 0;
        left: 4px;
    }

    .table .file-icon {
        text-align: left;
        font-size: 25px;
        color: #666;
        display: block;
        float: left;
    }

    .table .action-row .hide{
        display:none;
    }
    .table tr:hover .action-row .hide{
        display:block;
    }

    .list .file-icon {
        text-align: center;
        font-size: 58px;
        color: #666;
        display: block;
        height: 100px;
    }
    .list .form-check-input{
        display:none;
    }
    .list li:hover .form-check-input,
    .list li .form-check-input:checked{
        display:block;
    }

    .action-row {
        text-align: center;
    }

    .file-name{
        font-weight: bold;
        color: #666;
        display: block;
        overflow: hidden !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
    }

    .table .file-name {
        float: left;
        margin: 7px 0px 0px 10px;
    }

    .list .file-name{
        width:100%;
        float: none;
    }

    .file-name {
        font-weight: bold;
        color: #666;
        display: block;
        overflow: hidden !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
    }

    .file-icon.has-img>img {
        max-width: 100%;
        height: auto;
        max-height: 30px;
    }

    .file-icon.has-img>img {
        height: auto;
        max-height: 75px;
        max-width: 90px;
    }

    .file-info {
        text-align: center;
        padding: 10px;
        background: #f4f4f4;
    }

    .file-size {
        color: #999;
        font-size: 12px;
        display: block;
    }
    .list .file-size{
        width:100%;
    }

    .list .file-info {
        position: relative;
    }
    .list .file-info .btn-group{
        position: absolute;
        right:5px;
        bottom:5px;
        text-align:center;
    }

    .files {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .file-icon.has-img {
        padding: 0;
    }

</style>
<script data-exec-on-popstate>

    (function () {

        function defaultMediaMangerResponse(result){
            admin.ajax.reload();
            if (typeof result.data === 'object') {
                let data = result.data;
                if (data.status) {
                    admin.toastr.success(data.message);
                } else {
                    admin.toastr.error(data.message);
                }
            }
        }

        document.querySelectorAll('.file-delete').forEach( el => {
            el.addEventListener("click",function () {

                let path = this.dataset.path;

                Swal.fire({
                    title: "{{ __('admin.delete_confirm') }}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ __('admin.confirm') }}",
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false,
                    cancelButtonText: "{{ __('admin.cancel') }}",
                    preConfirm: function() {
                        return new Promise(function(resolve) {

                            let url = '{{ $url['delete'] }}';
                            let obj = {
                                method:'delete',
                                data : {'files': [path]},
                            };
                            admin.ajax.request(url,obj,resolve);
                        });
                    }
                }).then(function(result){
                    defaultMediaMangerResponse(result.value);
                });
            });
        });

        document.getElementById('moveModal').addEventListener('show.bs.modal', function (event) {

            let button = event.relatedTarget;
            let name = button.dataset.name;

            event.target.querySelector('[name=path]').value = name;
            event.target.querySelector('[name=new]').value = name;
        });

        document.getElementById('urlModal').addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let url = button.dataset.url;

            event.target.querySelector('input').value = url;
        });

        document.getElementById('file-move').addEventListener('submit', function (event) {

            event.preventDefault();

            let form = event.target;
            let path = form.querySelector('[name=path]').value;
            let name = form.querySelector('[name=new]').value;

            let url = '{{ $url['move'] }}';
            let obj = {
                method:'put',
                data : {
                    'path': path,
                    'new': name,
                },
            };
            admin.ajax.request(url,obj,function(result){
                defaultMediaMangerResponse(result);
            });

            bootstrap.Modal.getInstance(document.getElementById('moveModal')).hide();

        });

        document.querySelector('.file-upload').addEventListener('change', function () {
            document.querySelector('.file-upload-form').submit();
        });

        document.getElementById('new-folder').addEventListener('submit', function (event) {

            event.preventDefault();

            let formData = new FormData(event.target);

            let url = '{{ $url['new-folder'] }}';
            let obj = {
                method:'post',
                data : formData,
                async : false
            };
            admin.ajax.request(url,obj,function(result){
                defaultMediaMangerResponse(result);
            });
            bootstrap.Modal.getInstance(document.getElementById('newFolderModal')).hide();
        });


        document.querySelector('.media-reload').addEventListener('click',function () {
            admin.ajax.reload();
        });

        document.querySelector('.goto-url button').addEventListener('click',function () {

            let path = document.querySelector('.goto-url input').value;
            admin.ajax.navigate('{{ $url['index'] }}?path=' + path);
        });

        document.querySelector('.file-delete-multiple').addEventListener('click',function () {
            let files = [];
            document.querySelectorAll(".file-select input:checked").forEach( el => {
                files.push(el.value);
            });

            if (!files.length) {
                return;
            }

            Swal.fire({
                title: "{{ __('admin.delete_confirm') }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ __('admin.confirm') }}",
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                cancelButtonText: "{{ __('admin.cancel') }}",
                preConfirm: function() {
                    return new Promise(function(resolve) {

                        let url = "{{ $url['delete'] }}";
                        let obj = {
                            method:'delete',
                            data : {'files': files},
                        };
                        admin.ajax.request(url,obj,resolve);
                    });
                }
            }).then(function(result){
                defaultMediaMangerResponse(result.value);
            });
        });

    })();

</script>