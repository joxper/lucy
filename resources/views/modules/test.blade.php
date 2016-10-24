@extends('layouts.app')

@section('content')
    {!! $dataTable->table() !!}
@endsection

@section('scripts')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
{!! Html::script('assets/pages/scripts/table-datatables-managed.min.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endsection



