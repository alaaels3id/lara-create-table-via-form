@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if(session()->has('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @elseif(session()->has('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Table Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <label for="columns[0]" class="col-md-4 col-form-label text-md-end">{{ __('Column 1') }}</label>

                                <div class="col-md-6">
                                    <input id="columns[0]" type="text" class="form-control @error('columns.0') is-invalid @enderror" name="columns[0]" value="{{ old('columns.0') }}">

                                    @error('columns.0')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="attributes[0][]" class="col-md-4 col-form-label text-md-end">{{ __('Attributes') }}</label>
                                <div class="col-md-6">
                                    <select id="attributes[0][]" multiple class="form-control @error('attributes.0.0') is-invalid @enderror" name="attributes[0][]">
                                        <option value="string">String</option>
                                        <option value="unique">Unique</option>
                                        <option value="nullable">Nullable</option>
                                    </select>

                                    @error('attributes.0.0')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <label for="columns[1]" class="col-md-4 col-form-label text-md-end">{{ __('Column 2') }}</label>

                                <div class="col-md-6">
                                    <input id="columns[1]" type="text" class="form-control @error('columns.1') is-invalid @enderror" name="columns[1]" value="{{ old('columns.1') }}">

                                    @error('columns.1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="attributes[1][]" class="col-md-4 col-form-label text-md-end">{{ __('Attributes') }}</label>
                                <div class="col-md-6">
                                    <select id="attributes[1][]" multiple class="form-control @error('attributes.1.1') is-invalid @enderror" name="attributes[1][]">
                                        <option value="string">String</option>
                                        <option value="unique">Unique</option>
                                        <option value="nullable">Nullable</option>
                                    </select>

                                    @error('attributes.1.1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
