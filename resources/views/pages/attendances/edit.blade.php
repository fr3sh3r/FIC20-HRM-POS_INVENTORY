@extends('layouts.app')

@section('title', 'Edit Attendance')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Attendances</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Attendances</h2>



                <div class="card">
                    <form action="{{ route('attendances.update', $attendance) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="user_id">User ID</label>
                                {{-- <input type="text" name="user_id" class="form-control" value="{{ old('user_id') }}" --}}
                                <input type="text" name="user_id" class="form-control" value="{{ $attendance->user_id }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ old('date', $attendance->date ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="clock_in_date_time">Jam Masuk</label>
                                <input type="datetime-local" name="clock_in_date_time" class="form-control"
                                    value="{{ old('clock_in_date_time', $attendance->clock_in_date_time ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="clock_out_date_time">Jam Keluar</label>
                                <input type="datetime-local" name="clock_out_date_time" class="form-control"
                                    value="{{ old('clock_out_date_time', $attendance->clock_out_date_time ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="total_duration">Total Durasi (menit)</label>
                                <input type="number" name="total_duration" class="form-control"
                                    value="{{ old('total_duration') }}">
                            </div>

                            {{-- <div class="form-group">
                                <label for="total_duration">Total Durasi (menit)</label>
                                <input type="number" id="total_duration" name="total_duration" class="form-control"
                                    value="{{ old('total_duration') }}" readonly>
                            </div> --}}

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Hadir
                                    </option>
                                    <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Tidak Hadir
                                    </option>
                                    <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Terlambat
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_holiday">Libur</label>
                                <select name="is_holiday" class="form-control">
                                    <option value="0" {{ old('is_holiday') == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('is_holiday') == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_leave">Cuti</label>
                                <select name="is_leave" class="form-control">
                                    <option value="0" {{ old('is_leave') == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('is_leave') == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reason">Alasan</label>
                                <textarea name="reason" class="form-control" rows="3">{{ old('reason') }}</textarea>
                            </div>





                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
