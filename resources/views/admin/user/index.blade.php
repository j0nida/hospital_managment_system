@extends('layouts.adminLayout')

@section('content')

    <h1 class="m-0 text-dark">Lista e Punonjesve</h1>

    <br>

    <div class="container">

        <div class="card shadow mb-4">
            @include('alerts')

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Punonjes</h6>
            </div>

            <div class="card-body">

                <div>
                    <a class="btn btn-primary mb-3" id="add" href="{{ route('admin.user.create') }}">SHTO</a>
                        <input type="date" id="start" name="start" min="1920-01-01" max="2100-12-31" style="float:right">
                </div>

                <div class="datatable table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Emer</th>
                                <th>Mbiemer</th>
                                <th>Pozicioni</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tfoot>
                            <tr>
                                <th>Emer</th>
                                <th>Mbiemer</th>
                                <th>Pozicioni</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->position }}</td>
                                    <td>
                                        <a href="{{ route('user.profile',[ $user->id]) }}"
                                            class="btn btn-primary">SHIKO
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    {{-- <div class="d-sm-flex justify-content-center ">
                        {!! $users->links() !!}
                    </div> --}}
                </div>

            </div>
        </div>


    </div>

@endsection


@section('scripts')

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                "searching": true,
                "paging": false,
                "info": false,
                sDom: 'lrtip',
                orderCellsTop: true,
                fixedHeader: true,
                "order": [
                    [0, "asc"]
                ],
            });
        
            $("#start").attr('value',moment().format('yyyy-MM-DD'));
            $("#start").attr('max',moment().format('yyyy-MM-DD'));

            $("#start").change(function(){
                var date = new Date($('#start').val());
                    day = date.getDate();
                    month = date.getMonth() + 1;
                    year = date.getFullYear();
                    var d=[year, month, day].join('-');
                    
                    if(day==1){
                    $('#add').hide();
                    }
                $.ajax({
                    type: 'POST',
                    // method: "POST",
                    url: '/date',
                    data: {
                        date:d,
                        _token: '{{csrf_token()}}',
                        },
                    success: function(data) {
                    }
                });
                

            });
        });

    </script>
@endsection
