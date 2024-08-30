@extends('layouts.app')

@section('title', $title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($columns as $column)
                                @if (in_array($column, ['created_at', 'updated_at']))
                                    <div class="form-group col-md-6">
                                        <label
                                            for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                                        <p class="form-control-plaintext">{{ $item->$column }}</p>
                                    </div>
                                @else
                                    <div class="form-group col-md-6">
                                        <label
                                            for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                                        <p class="form-control-plaintext">{{ $item->$column }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ route($routePrefix . '.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
