@extends('admin.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Laporan Pendapatan</h1>

        {{-- Filter Form --}}
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label>Tahun</label>
                    <select name="year" class="form-control">
                        @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Bulan (opsional)</label>
                    <select name="month" class="form-control">
                        <option value="">-- Semua Bulan --</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="mb-3">
            <h5>Total Pendapatan: <strong>Rp {{ number_format($total_income, 0, ',', '.') }}</strong></h5>
            <a href="{{ route('admin.income.print-pdf', ['year' => $year, 'month' => $month]) }}" class="btn btn-danger"
                target="_blank">
                <i class="fas fa-file-pdf"></i> Cetak PDF
            </a>
        </div>


        {{-- Table Card --}}
        <div class="card">
            <div class="card-body">


                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Total Pendapatan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomes as $index => $income)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $income->year }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $income->month, 1)) }}</td>
                                <td>Rp {{ number_format($income->total_income, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
