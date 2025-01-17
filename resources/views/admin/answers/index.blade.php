@extends('admin.index')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="float:none;">{{ $title }}</h3>
        <a href="{{route('answer.create')}}" class="btn btn-primary" style="float: right">Thêm bài quiz </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="dataTable table table-bordered table-striped dtr-inline">
            <thead>
            <tr>
                <th>No</th>
                <th>Name Exame</th>
                <th style="text-align: center; width: 60px;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @foreach($listExam as $exame)
                    <?php $i++; ?>
                <tr>
                    <th>{{ $i }}</th>
                    <th>{{ $exame->title }}</th>
                    <th style="float: right;"><a rel="{{ $exame->id }}" class="deleteExam btn btn-danger" style="color: #fff;font-weight: bold;">Delete</a> </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form id="form_data" action="{{ aurl('exam/destroy/all') }}" method="POST">
            @csrf

            {!! $dataTable->table(['class' => 'dataTable table table-bordered table-striped dtr-inline'], true) !!}
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-danger">
                <p class="empty_record d-none">{{ trans('admin.please_check_record_number') }}</p>
                <p class="not_empty_record d-none">{{ trans('admin.confirm_delete_record') }} <span id="record_count"></span> {{ trans('admin.questionMark') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">{{ trans('admin.close') }}</button>
                <input type="submit" class="btn btn-primary btn-sm submit_delete_all" value="{{ trans('admin.okay') }}">
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        delete_All();
    });

    function delete_All() {
        $('.submit_delete_all').click(function() {
            $('#form_data').submit();
        });
    }
</script>
@endpush

@endsection
