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
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th style="width: 150px">Nama</th>
                                            <th style="width: 100px">NIM/NIS</th>
                                            <th style="width: 300px">Institusi</th>
                                            <th style="width: 300px">Fakultas</th>
                                            <th style="width: 150px">Jurusan</th>
                                            <th style="width: 200px">Waktu</th>
                                            <th style="width: 200px">Rekomendasi Magang</th>
                                            <th style="width: 200px">Bidang Penempatan</th>
                                            <th style="width: 100px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user as $users)
                                            <tr>
                                                <td>{{ $users->nama }}</td>
                                                <td>{{ $users->nim }}</td>
                                                <td>{{ $users->institusi }}</td>
                                                <td>{{ $users->fakultas }}</td>
                                                <td>{{ $users->jurusan }}</td>
                                                <td>{{ $users->waktu_mulai }} - {{ $users->waktu_selesai }}</td>
                                                <td>{{ $users->rekomendasi }}</td>
                                                <td>{{ $users->bidang }}</td>
                                                <td>
                                                    @if($users->status == 0)
                                                        <p class="fst-italic text-warning">Dalam Proses</p>
                                                    @elseif($users->status == 1)
                                                        <p class="fst-italic text-success">Diterima</p>
                                                    @elseif($users->status == 2)
                                                        <p class="fst-italic text-info">Berlangsung</p>
                                                    @elseif($users->status == 3)
                                                        <p class="fst-italic text-primary">Selesai</p>
                                                    @else
                                                        <p class="fst-italic text-danger">Ditolak</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                                <h6 class="font-extrabold mb-0">{{ $user->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="name ms-4 text-center">
                                <h5 class="mb-1">Upload Pengajuan Magang Mahasiswa</h5>
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