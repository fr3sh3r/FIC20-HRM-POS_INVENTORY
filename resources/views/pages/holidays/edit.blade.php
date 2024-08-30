@extends('layouts.app')

@section('title', $title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
            </div>
            <div class="section-body">
                <form action="{{ route($routePrefix . '.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @foreach ($columns as $column)
                                        <div class="form-group">
                                            <label
                                                for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>

                                            @if (strpos($column, 'id') !== false || strpos($column, '_id') !== false)
                                                <input type="text" class="form-control" id="{{ $column }}"
                                                    name="{{ $column }}" value="{{ $item->$column }}" disabled>
                                            @elseif (in_array($column, ['password']))
                                                <input type="password" name="{{ $column }}" class="form-control"
                                                    id="{{ $column }}" placeholder="Enter {{ $column }}">
                                            @elseif (in_array($column, ['email']))
                                                <input type="email" name="{{ $column }}" class="form-control"
                                                    id="{{ $column }}" value="{{ old($column, $item->$column) }}"
                                                    placeholder="Enter {{ $column }}">
                                            @elseif (in_array($column, ['created_at', 'updated_at']))
                                                <input type="text" class="form-control" id="{{ $column }}"
                                                    value="{{ $item->$column }}" disabled>
                                            @elseif (str_contains($column, 'date'))
                                                <input type="date" name="{{ $column }}" class="form-control"
                                                    id="{{ $column }}" value="{{ old($column, $item->$column) }}">
                                            @else
                                                <input type="text" name="{{ $column }}" class="form-control"
                                                    id="{{ $column }}" value="{{ old($column, $item->$column) }}"
                                                    placeholder="Enter {{ $column }}">
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <a href="{{ route($routePrefix . '.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
