@extends(get_theme_dir('layouts.app', 'dashboard'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-5x">
                    <div class="row align-items-center g-2">
                        <div class="col-lg-3 me-auto">
                            <h6 class="card-title mb-0">{{ trans_choice('messages.Order', 2) }}</h6>
                        </div><!--end col-->
                        
                    </div><!--end row-->
                </div>
                <div class="card-body mt-3">
                    <div class="table-responsive list-shipment">
                        <table class="table" id="table1">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>@lang('Order ID')</th>
                                    <th>@lang('messages.Created')</th>
                                    <th>@lang('Product')</th>
                                    @can('do_staff')
                                        <th>{{ trans_choice('messages.Customer', 1) }}</th>
                                    @endcan
                                    <th>@lang('messages.Amount')</th>
                                    <th>{{ trans_choice('Order Status', 1) }}</th>
                                    <th>{{ trans_choice('messages.Payment_Method', 1) }}</th>
                                    <th>{{ trans_choice('messages.Payment_Status', 1) }}</th>
                                    <th>@lang('messages.Action')</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset(get_theme_dir('plugins')) }}/datatables/dataTables.bootstrap5.min.css" rel="stylesheet">
   
@endpush

@push('scripts')
    <script src="{{ asset(get_theme_dir('plugins')) }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(get_theme_dir('plugins')) }}/datatables/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.table').DataTable({
                language: {
                    url: "{{ asset(get_theme_dir('plugins')) }}/datatables/{{ LaravelLocalization::getCurrentLocale() }}.json"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.shipments.orders.datatable', ['type' => 'all', 'id' => 'all']) }}",
                columns: [{
                        data: 'invoice_id',
                        name: 'invoice_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    @can('do_staff')
                    {
                        data: 'owner_id',
                        name: 'owner_id'
                    },
                    @endcan
                    {
                        data: 'shipping_cost',
                        name: 'shipping_cost'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                   
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endpush
