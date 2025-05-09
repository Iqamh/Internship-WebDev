@extends('layouts.main')

@section('magangContent')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Pengajuan Magang</h3>
                    <p class="text-subtitle text-muted">Input Data Mahasiswa Magang</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ Route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Pengajuan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="col-12">
                <h2 class="contact-title">Form</h2>
                @if(session('Messagge'))
                <div class="alert alert-success justify-content-between" role="alert" id="successAlert">
                    Congratulations. Your Message has been Send successfully
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="closeButton">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="{{ Route('form.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Nama Ketua<span class="text-danger">*</span></label>
                                                <input type="text" id="first-name-column" class="form-control" placeholder="Nama Lengkap Ketua" name="nama_ketua" required>
                                            </div>
                                        </div>
                                        <div class="col col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Nama Anggota <span class="text-secondary small">(opsional)</span></label>
                                                <input type="text" id="first-name-column" class="form-control" placeholder="Nama Lengkap Anggota (Pisahkan dengan koma jika lebih dari satu)" name="nama_anggota">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">NIM/NIS Ketua<span class="text-danger">*</span></label>
                                                <input type="text" id="city-column" class="form-control" placeholder="1456286412" name="nim_ketua" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">NIM/NIS Anggota <span class="text-secondary small">(opsional)</span></label>
                                                <input type="text" id="city-column" class="form-control" placeholder="1456286412, 156878656, ..." name="nim_anggota">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">Nomor HP<span class="text-danger">*</span></label>
                                                <input type="text" id="country-floating" class="form-control" name="noHP" placeholder="08xxxxxxxxxx" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Email<span class="text-danger">*</span></label>
                                                <input type="email" id="email-id-column" class="form-control" name="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Institusi<span class="text-danger">*</span></label>
                                                <input type="text" id="company-column" class="form-control" name="institusi" placeholder="Institusi" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Fakultas<span class="text-danger">*</span></label>
                                                <input type="text" id="company-column" class="form-control" name="fakultas" placeholder="Fakultas" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Jurusan<span class="text-danger">*</span></label>
                                                <input type="text" id="company-column" class="form-control" name="jurusan" placeholder="Jurusan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Tanggal Mulai<span class="text-danger">*</span></label>
                                                <input type="date" id="email-id-column" class="form-control" name="waktu_mulai" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Tanggal Selesai<span class="text-danger">*</span></label>
                                                <input type="date" id="email-id-column" class="form-control" name="waktu_selesai" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Judul Penelitian<span class="text-danger">*</span></label>
                                                <input type="text" id="company-column" class="form-control" name="judul" placeholder="Judul Penelitian" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Nomor Surat Rekomendasi<span class="text-danger">*</span></label>
                                                <input type="text" id="email-id-column" class="form-control" name="rekomendasi" placeholder="Nomor Surat Rekomendasi" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="formFileSm" class="form-label">Upload Proposal<span class="text-danger">*</span></label>
                                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="file" required>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->
    </div>
@endsection