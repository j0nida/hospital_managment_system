@extends('layouts.adminLayout')

@section('content')

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="text-center mt-2">SHTO PUNONJES</h5>
                        </div>

                        <form 
                         action="{{ route('admin.user.store') }}" 
                         method="POST"
                         enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                @include('alerts')

                                <fieldset>
                                    <div class="form-group">
                                        <label for="">Emri</label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                        @error('first_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Mbiemri</label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                        @error('last_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Pozicioni</label>
                                        <select name="position" class="form-control" >
                                            <option hidden disabled selected value> -- select an option -- </option>
                                                <option value="doktor">
                                                    Doktor
                                                </option>
                                                <option value="infermier">
                                                    Infermier
                                                </option>
                                                <option value="sanitar">
                                                    Sanitar
                                                </option>
                                        </select>
                                        @error('position')
                                            <div class="text-danger">
                                                Please select a valid option
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="">Paga per ore</label>
                                        <input type="number" name="wage_per_hour" value="{{ old('wage_per_hour') }}" class="form-control">
                                        @error('wage_per_hour')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Data e Regjistrimit</label>
                                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control">
                                        @error('start_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                            </fieldset>


                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary"
                            style="width: 40%; font-size:1.3rem">REGJISTRO</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </section>

@endsection
