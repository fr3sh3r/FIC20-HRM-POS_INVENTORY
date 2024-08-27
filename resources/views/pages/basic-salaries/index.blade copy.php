@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ $title }}</h1>

        <pre>{{ print_r($data->toArray(), true) }}</pre>


        @if (count($data) > 0)
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
                                <td>
                                    @if (isset($item->$column))
                                        {{ $item->$column }}
                                    @else
                                        N/A (Data Missing)
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route($routePrefix . '.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data untuk ditampilkan.</p>
        @endif

    </div>
@endsection
