@extends('layouts.adminLayout')

@section('content')

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="text-center mt-2">Shto punonjes ne turne</h5>
                        </div>

                        <form 
                         action="{{ route('shift.emp.store') }}" 
                         method="POST"
                         enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                @include('alerts')

                                <fieldset>
                                    <div class="form-group">
                                        <label for="">Punonjesi</label>
                                        <select name="user" class="form-control" >
                                            <option hidden disabled selected value> -- zgjidh nje punonjes -- </option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @if (old('user') == $user->id) selected @endif>
                                                    {{ $user->first_name."   ".$user->last_name." => ".$user->position }}
                                                </option>
                                                @endforeach
                                        </select>
                                        @error('user')
                                            <div class="text-danger">
                                                Please select a valid option
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Turni</label>
                                        <select name="shift" class="form-control" >
                                            <option hidden disabled selected value> -- zgjidh turnin -- </option>
                                                @foreach ($shifts as $shift)
                                                <option value="{{ $shift->id }}" @if (old('shift') == $shift->id) selected @endif>
                                                    {{ $shift->shift_name." => ". $shift->shift_start_time." : ".$shift->shift_end_time}}
                                                </option>
                                                @endforeach
                                        </select>
                                        @error('shift')
                                            <div class="text-danger">
                                                Please select a valid option
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Data </label>
                                        <input type="date" name="shift_date" value="{{ old('shift_date') }}" class="form-control">
                                        @error('shift_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                            </fieldset>


                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary"
                            style="width: 40%; font-size:1.3rem">SHTO</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </section>

@endsection
