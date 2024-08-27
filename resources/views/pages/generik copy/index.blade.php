@extends('layouts.app')

@section('title', $title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
                <div class="section-header-button" style="margin-left: 40px;">
                    <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="float-right" style="margin-left: 40px;">
                    <form method="GET" action="{{ route($routePrefix . '.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="query"
                                value="{{ request('query') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="section-body">
                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        @foreach ($columns as $column)
                                            <td>{{ $item->$column }}</td>
                                        @endforeach
                                        <td>
                                            <a href="{{ route($routePrefix . '.show', $item->id) }}"
                                                class="btn btn-info">Show</a>
                                            <a href="{{ route($routePrefix . '.edit', $item->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route($routePrefix . '.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">hapus</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $data->links() }}
                    </div>
                @else
                    <p>Tidak ada data untuk ditampilkan.</p>
                @endif
            </div>
        </section>
    </div>
@endsection
