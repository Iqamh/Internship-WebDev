@extends('layouts.main')

@section('magangContent')
    <div class="page-heading">
        <h3>Data Mahasiswa Magang</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-8">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="search-container">
                                <input type="text" class="search-input" id="searchInput" oninput="updateTable()" placeholder="Search..."> <!-- Search bar -->
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM/NIS</th>
                                            <th>Institusi</th>
                                            <th>Fakultas</th>
                                            <th>Jurusan</th>
                                            <th>Waktu</th>
                                            <th>Rekomendasi Magang</th>
                                            <th>Bidang Penempatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($groups as $group)
                                            @php
                                                $ketua = $group->ketua;
                                                $anggotaList = $group->anggota;
                                                $totalAnggota = count($anggotaList);
                                            @endphp
                                            <tr data-group-id="{{ $group->group_id }}">
                                                <td>{{ $ketua->nama }}</td>
                                                <td>{{ $ketua->nim }}</td>
                                                <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->institusi }}</td>
                                                <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->fakultas }}</td>
                                                <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->jurusan }}</td>
                                                <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->waktu_mulai }} - {{ $ketua->waktu_selesai }}</td>
                                                <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->rekomendasi }}</td>
                                                <td>
                                                    @if($ketua->bidang == 0)
                                                        Belum Ditentukan
                                                    @elseif($ketua->bidang == 1)
                                                        Sekretariat
                                                    @elseif($ketua->bidang == 2)
                                                        Bidang Koperasi
                                                    @elseif($ketua->bidang == 3)
                                                        Bidang Pemberdayaan Usaha Mikro
                                                    @elseif($ketua->bidang == 4)
                                                        Bidang Pembinaan Usaha Perdagangan
                                                    @elseif($ketua->bidang == 5)
                                                        Bidang Distribusi Perdagangan
                                                    @else
                                                        Bidang UPTD Metrologi Legal
                                                    @endif
                                                </td>
                                                <td rowspan="{{ $totalAnggota + 1 }}">
                                                    @if($ketua->status == 0)
                                                        <p class="fst-italic text-warning">Dalam Proses</p>
                                                    @elseif($ketua->status == 1)
                                                        @if($ketua->isWithinDateRange())
                                                            <p class="fst-italic text-info">Berlangsung</p>
                                                        @elseif($ketua->isPastEndDate())
                                                            <p class="fst-italic text-primary">Selesai</p>
                                                        @else
                                                            <p class="fst-italic text-success">Diterima</p>
                                                        @endif
                                                    @else
                                                        <p class="fst-italic text-danger">Ditolak</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            @foreach($anggotaList as $anggota)
                                                <tr data-group-id="{{ $group->group_id }}">
                                                    <td>{{ $anggota->nama }}</td>
                                                    <td>{{ $anggota->nim }}</td>
                                                    <td>
                                                        @if($anggota->bidang == 0)
                                                            Belum Ditentukan
                                                        @elseif($anggota->bidang == 1)
                                                            Sekretariat
                                                        @elseif($anggota->bidang == 2)
                                                            Bidang Koperasi
                                                        @elseif($anggota->bidang == 3)
                                                            Bidang Pemberdayaan Usaha Mikro
                                                        @elseif($anggota->bidang == 4)
                                                            Bidang Pembinaan Usaha Perdagangan
                                                        @elseif($anggota->bidang == 5)
                                                            Bidang Distribusi Perdagangan
                                                        @else
                                                            Bidang UPTD Metrologi Legal
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-7">
                                    {{ $groups->links('layouts.pagination') }}
                                </div>
                                <div class="col-lg-4">
                                    @if($groups->total() > 0)
                                        <p>Showing {{ $groups->firstItem() }} to {{ $groups->lastItem() }} of {{ $groups->total() }} Data</p>
                                    @else
                                        <p>No Data Found</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="d-flex justify-content-start ">
                            <div class="stats-icon purple">
                                <i class="iconly-boldShow"></i>
                            </div>
                            <div class="px-2">
                                <h6 class="text-muted font-semibold">Jumlah Mahasiswa Magang</h6>
                                <h6 class="font-extrabold mb-0">{{ $groups->total() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="d-flex justify-content-start ">
                            <div class="stats-icon orange">
                                <i class="iconly-boldShow"></i>
                            </div>
                            <div class="px-2">
                                <h6 class="text-muted font-semibold">Jumlah yang sedang Diproses</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalDiproses }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="d-flex justify-content-start ">
                            <div class="stats-icon blue">
                                <i class="iconly-boldShow"></i>
                            </div>
                            <div class="px-2">
                                <h6 class="text-muted font-semibold">Mahasiswa sedang Magang</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalBerlangsung }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="d-flex justify-content-start ">
                            <div class="stats-icon yellow">
                                <i class="iconly-boldShow"></i>
                            </div>
                            <div class="px-2">
                                <h6 class="text-muted font-semibold">Mahasiswa Selesai Magang</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalSelesai }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="d-flex justify-content-start ">
                            <div class="stats-icon red">
                                <i class="iconly-boldShow"></i>
                            </div>
                            <div class="px-2">
                                <h6 class="text-muted font-semibold">Jumlah yang Ditolak</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalDitolak }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="name ms-4 text-center">
                                <h5 class="mb-1">Upload Berkas Magang Mahasiswa</h5>
                            </div>
                        </div>
                        <div class="px-4">
                            <a href="{{ Route('form') }}" class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Upload</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection