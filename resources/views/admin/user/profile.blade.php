@extends('layouts.adminLayout')

@section('content')

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="text-center mt-2">Te dhenat e punonjesit</h5>
                        </div>
                        <div class="card-body">
                            <table class="table profile-table table-hover">
                                <tr>
                                    <td>Emri</td>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Mbiemri</td>
                                    <td>{{ $user->last_name }}</td>
                                </tr>

                                <tr>
                                    <td>Pozicioni</td>
                                    <td>{{ $user->position }}</td>
                                </tr>

                                <tr>
                                    <td>Paga per ore(Lek/Ore)</td>
                                    <td>{{ $user->wage_per_hour }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Data e regjistrimit</td>
                                    <td>{{ $user->start_date }}</td>
                                </tr>

                                <tr>
                                    <td>Oret e Punes</td>
                                    <td>{{$hours}}</td>
                                </tr>

                                <tr>
                                    <td>Paga (leke)</td>
                                    <td>{{$hours*$user->wage_per_hour}}</td>
                                </tr>
                            </table>
                        </div>
                        @if ($isLastDay) 
                        <div class="card-footer text-center">
                            <form method="post" action="{{ route('admin.user.destroy', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-flat btn-danger  btn-sm">FSHI</button>
                            </form>                  
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
