@extends('layouts.app')

@section('title', 'Create ' . $title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create {{ $title }}</h1>
            </div>
            <div class="section-body">
                <form action="{{ route($routePrefix . '.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @foreach ($columns as $column)
                                        @if (!str_contains($column, 'id') && !str_contains($column, '_id'))
                                            <div class="form-group">
                                                <label
                                                    for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>

                                                @if (in_array($column, ['password']))
                                                    <input type="password" name="{{ $column }}" class="form-control"
                                                        id="{{ $column }}" placeholder="Enter {{ $column }}">
                                                @elseif (in_array($column, ['email']))
                                                    <input type="email" name="{{ $column }}" class="form-control"
                                                        id="{{ $column }}" value="{{ old($column) }}"
                                                        placeholder="Enter {{ $column }}">
                                                @elseif (str_contains($column, 'date'))
                                                    <input type="date" name="{{ $column }}" class="form-control"
                                                        id="{{ $column }}" value="{{ old($column) }}">
                                                @else
                                                    <input type="text" name="{{ $column }}" class="form-control"
                                                        id="{{ $column }}" value="{{ old($column) }}"
                                                        placeholder="Enter {{ $column }}">
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
