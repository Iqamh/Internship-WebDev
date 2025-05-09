@extends('layouts.main')

@section('magangContent')
    <div class="page-heading">
        <h3>Data Mahasiswa Magang</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Mahasiswa Magang</h6>
                                    <h6 class="font-extrabold mb-0">{{ $groups->total() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon orange mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah sedang Diproses</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalDiproses }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Mahasiswa sedang Magang</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalBerlangsung }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon yellow mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Mahasiswa Selesai Magang</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totalSelesai }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h2 class="contact-title">Form</h2>
                @if(session('Messagge'))
                <div class="alert alert-success justify-content-between" role="alert" id="successAlert">
                    Congratulations. Data Has been Changed
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="closeButton">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
            </div>
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
                                        <th>Nomor HP</th>
                                        <th>Email</th>
                                        <th>Institusi</th>
                                        <th>Fakultas</th>
                                        <th>Jurusan</th>
                                        <th>Judul Proposal</th>
                                        <th>Waktu</th>
                                        <th>Rekomendasi Magang</th>
                                        <th colspan="2">Surat Keterangan</th>
                                        <th>Bidang Penempatan</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->noHP }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->email }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->institusi }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->fakultas }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->jurusan }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->judul }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->waktu_mulai }} - {{ $ketua->waktu_selesai }}</td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">{{ $ketua->rekomendasi }}</td>
                                            <td>
                                                <input type="text" class="suket" name="surat_ketua" data-group-id="{{ $group->group_id }}" value={{ ($ketua->surat ==  NULL) ? '-' : $ketua->surat }} @if($ketua->status == 0 || $ketua->status == 4 || ($ketua->status == 1 && !$ketua->isPastEndDate())) disabled @endif>
                                            </td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">
                                                <button class="btn btn-sm btn-primary" data-group-id="{{ $group->group_id }}" onclick="console.log('Button clicked with groupId:', '{{ $group->group_id }}'); updateSurat('{{ $group->group_id }}')" @if($ketua->status == 0 || $ketua->status == 4 || ($ketua->status == 1 && !$ketua->isPastEndDate())) disabled @endif><i class="fa-solid fa-pen-to-square"></i></button>
                                            </td>
                                            <td>
                                                <form class="bidang-form" action="{{ route('admin.updateBidangKetua', $ketua->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <select class="bidang-dropdown" name="new_bidang" onchange="updateBidang(event, {{ $ketua->id }}, 'ketua')" @if($ketua->status == 0 || $ketua->status == 4 || ($ketua->status == 1 && !$ketua->isPastEndDate())) disabled @endif>
                                                        <option value="0" selected disabled>Belum Ditentukan</option>
                                                        <option value="1" @if($ketua->bidang == 1) selected @endif>Sekretariat</option>
                                                        <option value="2" @if($ketua->bidang == 2) selected @endif>Bidang Koperasi</option>
                                                        <option value="3" @if($ketua->bidang == 3) selected @endif>Bidang Pemberdayaan Usaha Mikro</option>
                                                        <option value="4" @if($ketua->bidang == 4) selected @endif>Bidang Pembinaan Usaha Perdagangan</option>
                                                        <option value="5" @if($ketua->bidang == 5) selected @endif>Bidang Distribusi Perdagangan</option>
                                                        <option value="6" @if($ketua->bidang == 6) selected @endif>Bidang UPTD Metrologi Legal</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td rowspan="{{ $totalAnggota + 1 }}">
                                                <form class="status-form" action="{{ route('admin.upStatus', $ketua->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <select class="status-dropdown" name="new_status" style="width: 150px" onchange="this.form.submit()">
                                                        @if($ketua->status == 0)
                                                            <option value="0" selected disabled>Dalam Proses</option>
                                                            <option value="1">Diterima</option>
                                                            <option value="4">Ditolak</option>
                                                        @elseif($ketua->status == 1)
                                                            @if($ketua->isWithinDateRange())
                                                                <option value="2">Berlangsung</option>
                                                            @elseif($ketua->isPastEndDate())
                                                                <option value="3">Selesai</option>
                                                            @else
                                                                <option value="1">Diterima</option>
                                                            @endif
                                                        @elseif($ketua->status == 4)
                                                            <option value="4">Ditolak</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            </td>
                                            <td rowspan="{{ $totalAnggota + 1 }}" class="text-center">
                                                <span>
                                                    <a href="{{ route('download.pdf', ['filename' => urlencode(basename($ketua->file))]) }}" class="mb-2 btn btn-sm btn-primary"><i class="fa-solid fa-file-arrow-down"></i></a>
                                                </span>
                                                <form action="{{ Route('admin.delete', $ketua->id) }}" method="POST" files="true" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="mb-2 btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @foreach($anggotaList as $anggota)
                                            <tr data-group-id="{{ $group->group_id }}">
                                                <td>{{ $anggota->nama }}</td>
                                                <td>{{ $anggota->nim }}</td>
                                                <td>
                                                    <input type="text" class="suket" name="surat_anggota[]" data-group-id="{{ $group->group_id }}" value={{ ($anggota->surat ==  NULL) ? '-' : $anggota->surat }} @if($ketua->status == 0 || $ketua->status == 4 || ($ketua->status == 1 && !$ketua->isPastEndDate())) disabled @endif>
                                                </td>
                                                <td>
                                                    <form class="bidang-form" action="{{ route('admin.updateBidangAnggota', $anggota->id) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <select class="bidang-dropdown" name="new_bidang" onchange="updateBidang(event, {{ $anggota->id }}, 'anggota')" @if($ketua->status == 0 || $ketua->status == 4 || ($ketua->status == 1 && !$ketua->isPastEndDate())) disabled @endif>
                                                            <option value="0" selected disabled>Belum Ditentukan</option>
                                                            <option value="1" @if($anggota->bidang == 1) selected @endif>Sekretariat</option>
                                                            <option value="2" @if($anggota->bidang == 2) selected @endif>Bidang Koperasi</option>
                                                            <option value="3" @if($anggota->bidang == 3) selected @endif>Bidang Pemberdayaan Usaha Mikro</option>
                                                            <option value="4" @if($anggota->bidang == 4) selected @endif>Bidang Pembinaan Usaha Perdagangan</option>
                                                            <option value="5" @if($anggota->bidang == 5) selected @endif>Bidang Distribusi Perdagangan</option>
                                                            <option value="6" @if($anggota->bidang == 6) selected @endif>Bidang UPTD Metrologi Legal</option>
                                                        </select>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-6">
                                {{ $groups->links('layouts.pagination') }}
                            </div>
                            <div class="col-lg-3">
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
        </section>
    </div>
@endsection