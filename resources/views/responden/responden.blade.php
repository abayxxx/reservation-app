@extends('layouts.guest')
@section('title', 'Questionnaire')
@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4" style="background-image:url('/../landing_page/images/image.png')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center mb-5">
                <h1 class="text-white" style="font-weight:900">PT.BEST SURVEY</h1>
                <h4 class="text-white">SURVEY KEPUASAN KONSUMEN</h4>
            </div>

            <div class="col-lg-10 col-md-10 d-flex flex-column align-items-center justify-content-center py-5 rounded" style="background-color: #EDEADE;" id="halaman-responden">

                <h2 class="mb-3">General Information</h2>

                <div class="w-75">
                    <form>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1 " class="mb-1">Email</label>
                            <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" class="form-control form-control-lg" id="email" aria-describedby="emailHelp" placeholder="Masukkan email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1" class="mb-1">Nama</label>
                            <input type="text" class="form-control form-control-lg" id="nama" placeholder="Nama">
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="exampleInputPassword1" class="mb-1">Umur</label>
                            <input type="text" class="form-control form-control-lg" id="umur" placeholder="Umur">
                        </div> -->

                        <label for="" class="mb-2 pagetitle">Jenis Kelamin</label>
                        <div class="d-flex justify-content mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="flexRadioDefault1" value="Laki-laki" style="transform: scale(2);">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check" style="margin-left: 30px;">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="flexRadioDefault2" value="Perempuan" style="transform: scale(2);">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-back" id="btn-back">Kembali</button>

                            <button type="submit" class="btn btn-primary btn-responden" id="btn-responden">Selanjutnya</button>

                        </div>
                    </form>
                </div>
            </div>
            @include('responden.pertanyaan')
            @include('responden.submit')
        </div>

    </div>
    </div>
</section>

@endsection

{{-- addons css --}}
@push('css')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</link>
<style>
    .btn-default-click {
        /* color: #fd4900 !important; */
        background-color: #fd4900 !important;
        color: white !important;
    }
</style>

@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn-back').click(function() {
            window.location.href = "/";
        })

        if (localStorage.getItem('responden') != null) {
            $('#halaman-responden').addClass('d-none');
            $('#halaman-pertanyaan').removeClass('d-none');

            var responden = JSON.parse(localStorage.getItem('responden'));
            $('#email').val(responden.email);
            $('#nama').val(responden.nama);
            $('input[name="jenis_kelamin"][value="' + responden.jenis_kelamin + '"]').prop('checked', true);


        }
        //data responden
        $('#btn-responden').on('click', function(e) {
            e.preventDefault();

            var responden = {
                email: $('#email').val(),
                nama: $('#nama').val(),
                jenis_kelamin: $('input[name="jenis_kelamin"]:checked').val(),
                umur: $('#umur').val(),
            }
            if (!$('#email')[0].checkValidity()) {

                alert('Email tidak valid');
                return false
            }

            if (responden.email == '' || responden.nama == '' || responden.jenis_kelamin == '' || responden.umur == '') {
                alert('Data tidak boleh kosong');
                return false;
            }

            //save to local storage
            localStorage.setItem('responden', JSON.stringify(responden));

            //add class hidden halaman responden
            $('#halaman-responden').addClass('d-none');

            //remove class hidden halaman pertanyaan
            $('#halaman-pertanyaan').removeClass('d-none');


        });

        var last_question_id = 1;
        var current_number = 1;
        var pertanyaan = @json($pertanyaan);
        var count = @json($count);
        var currentQuestionId = $('#pertanyaan_id').data('pertanyaan-id')
        var currentQuestion = 1; // Variabel untuk menyimpan urutan pertanyaan saat ini
        var a_first = localStorage.getItem('a_first') != null ? JSON.parse(localStorage.getItem('a_first')) : {};
        var a_second = localStorage.getItem('a_second') != null ? JSON.parse(localStorage.getItem('a_second')) : {};

        $('#pertanyaan').html(pertanyaan.pertanyaan);
        $('#pertanyaan_id').data('pertanyaan-id', pertanyaan.id);
        $('#kriteria').html(pertanyaan.kriteria.kriteria);
        $('#total_pertanyaan').text(`Pertanyaan Ke-${currentQuestion} Dari ${count}`);

        // Panggil fungsi untuk menampilkan pertanyaan sebelumnya saat tombol diklik
        $('#prev-question-submit').on('click', function(e) {
            e.preventDefault();
            if (currentQuestion > 1) {
                last_question_id = localStorage.getItem('last_question_id');
                current_number = localStorage.getItem('current_number');
                currentQuestion = current_number;
                $('#pertanyaan_id').data('pertanyaan-id', last_question_id);
                loadRestoreQuestion();
                $('#halaman-pertanyaan').removeClass('d-none');
                $('#halaman-submit').addClass('d-none');

            }
        });


        // Panggil fungsi untuk menampilkan pertanyaan sebelumnya saat tombol diklik
        $('#prev-question').on('click', function(e) {
            e.preventDefault();
            if (currentQuestion > 1) {
                loadPreviousQuestion();

            } else {
                //add class hidden halaman responden
                $('#halaman-responden').removeClass('d-none');

                //remove class hidden halaman pertanyaan
                $('#halaman-pertanyaan').addClass('d-none');
            }
        });

        // Panggil fungsi untuk menampilkan pertanyaan berikutnya saat tombol diklik
        $('#next-question').on('click', function(e) {
            e.preventDefault();
            if (currentQuestion < count) {
                // console.log(document.querySelector('input[name="a_first"]:checked').value)
                // console.log(document.querySelector('input[name="a_second"]:checked').value)

                //radio button must be filled
                if (document.querySelector('input[name="a_first"]:checked') == null || document.querySelector('input[name="a_second"]:checked') == null) {
                    alert('Jawaban Harus di isi');
                    return false;
                }

                loadNextQuestion();
            } else if (currentQuestion == count) {
                if (document.querySelector('input[name="a_first"]:checked') == null || document.querySelector('input[name="a_second"]:checked') == null) {
                    alert('Jawaban Harus di isi');
                    return false;
                }
                a_first[currentQuestionId] = $('input[name="a_first"]:checked').val();
                a_second[currentQuestionId] = $('input[name="a_second"]:checked').val();

                //save to local storage
                localStorage.setItem('a_first', JSON.stringify(a_first));
                localStorage.setItem('a_second', JSON.stringify(a_second));

                //set submit page value to local storage
                localStorage.setItem('submit-page', true);


                $('#halaman-pertanyaan').addClass('d-none');
                $('#halaman-submit').removeClass('d-none');
            }
        });
        //restore data question
        if (localStorage.getItem('last_question_id') != null) {
            var last_question_id = localStorage.getItem('last_question_id');
            var current_number = localStorage.getItem('current_number');
            currentQuestion = current_number;
            $('#pertanyaan_id').data('pertanyaan-id', last_question_id);

            loadRestoreQuestion();

        }

        function loadRestoreQuestion() {
            $.ajax({
                type: 'GET',
                url: '/responden/pertanyaan/' + last_question_id + '/restore',
                success: function(data) {

                    $('#pertanyaan').text(data.pertanyaan.pertanyaan);
                    $('#pertanyaan_id').data('pertanyaan-id', data.pertanyaan.id);
                    $('#kriteria').text(data.pertanyaan.kriteria.kriteria);
                    currentQuestionId = $('#pertanyaan_id').data('pertanyaan-id');
                    $('#total_pertanyaan').text(`Pertanyaan Ke-${current_number} Dari ${count}`); // Tampilkan urutan pertanyaan saat ini

                    //remove data local storage
                },
                error: function() {
                    alert('Failed to load previous question.');
                }
            });
        }

        function restoreDataAttribute() {
            var currentQuestionId = $('#pertanyaan_id').data('pertanyaan-id')
            var first_a = a_first[currentQuestionId];
            var second_a = a_second[currentQuestionId];
            if (first_a !== undefined) {
                $('input[name="a_first"]').filter(`[value="${first_a}"]`).prop('checked', true);
            }
            if (second_a !== undefined) {
                $('input[name="a_second"]').filter(`[value="${second_a}"]`).prop('checked', true);
            }
        }


        // Check if the data exists in local storage on page load
        restoreDataAttribute();



        // Fungsi untuk memuat pertanyaan sebelumnya menggunakan AJAX
        function loadPreviousQuestion() {
            $.ajax({
                type: 'GET',
                url: '/responden/pertanyaan/' + $('#pertanyaan_id').data('pertanyaan-id') + '/prev',
                success: function(data) {
                    if (currentQuestion > 1) {

                        $('#pertanyaan').text(data.pertanyaan.pertanyaan);
                        $('#pertanyaan_id').data('pertanyaan-id', data.pertanyaan.id);
                        $('#kriteria').text(data.pertanyaan.kriteria.kriteria);
                        currentQuestionId = $('#pertanyaan_id').data('pertanyaan-id');
                        currentQuestion--; // Kurangi urutan pertanyaan saat ini
                        $('#total_pertanyaan').text(`Pertanyaan Ke-${currentQuestion} Dari ${count}`); // Tampilkan urutan pertanyaan saat ini

                        //save to local storage
                        localStorage.setItem('a_first', JSON.stringify(a_first));
                        localStorage.setItem('a_second', JSON.stringify(a_second));

                        //set last question id to localstorage
                        localStorage.setItem('last_question_id', currentQuestionId);
                        localStorage.setItem('current_number', currentQuestion);

                        // Restore the previous selected radio button value
                        if (a_first[currentQuestionId] !== undefined) {
                            $('input[name="a_first"]').filter(`[value="${a_first[currentQuestionId]}"]`).prop('checked', true);
                        }
                        if (a_second[currentQuestionId] !== undefined) {
                            $('input[name="a_second"]').filter(`[value="${a_second[currentQuestionId]}"]`).prop('checked', true);
                        }
                    }

                },
                error: function() {
                    alert('Failed to load previous question.');
                }
            });
        }

        // Fungsi untuk memuat pertanyaan berikutnya menggunakan AJAX
        function loadNextQuestion() {
            // Save the current selected radio button value
            a_first[currentQuestionId] = $('input[name="a_first"]:checked').val();
            a_second[currentQuestionId] = $('input[name="a_second"]:checked').val();

            $.ajax({
                type: 'GET',
                url: '/responden/pertanyaan/' + $('#pertanyaan_id').data('pertanyaan-id') + '/next',
                success: function(data) {
                    // Clear the selection of radio buttons for the next question
                    $('input[name="a_first"]').prop('checked', false);
                    $('input[name="a_second"]').prop('checked', false);

                    $('#pertanyaan').text(data.pertanyaan.pertanyaan);
                    $('#pertanyaan_id').data('pertanyaan-id', data.pertanyaan.id);
                    currentQuestionId = $('#pertanyaan_id').data('pertanyaan-id');

                    $('#kriteria').text(data.pertanyaan.kriteria.kriteria);
                    currentQuestion++; // Tambahkan urutan pertanyaan saat ini
                    $('#total_pertanyaan').text(`Pertanyaan Ke-${currentQuestion} Dari ${count}`); // Tampilkan urutan pertanyaan saat ini

                    //save to localstorage
                    localStorage.setItem('a_first', JSON.stringify(a_first));
                    localStorage.setItem('a_second', JSON.stringify(a_second));

                    //set last question id to localstorage
                    localStorage.setItem('last_question_id', currentQuestionId);
                    localStorage.setItem('current_number', currentQuestion);

                    // Restore the previous selected radio button value
                    // Restore the previous selected radio button value
                    if (a_first[currentQuestionId] !== undefined) {
                        $('input[name="a_first"]').filter(`[value="${a_first[currentQuestionId]}"]`).prop('checked', true);
                    }
                    if (a_second[currentQuestionId] !== undefined) {
                        $('input[name="a_second"]').filter(`[value="${a_second[currentQuestionId]}"]`).prop('checked', true);
                    }

                },
                error: function() {
                    alert('Failed to load next question.');
                }
            });


        }


        // fungsi untuk submit semua jawaban dan data responden

        //send to controoler using ajax
        $('#submit-question').on('click', function(event) {
            event.preventDefault();
            let url = '';

            url = "{{ route('guest.submit.pertanyaan') }}";

            //get data from local storage
            var a_first = JSON.parse(localStorage.getItem('a_first'));
            var a_second = JSON.parse(localStorage.getItem('a_second'));
            var responden = JSON.parse(localStorage.getItem('responden'));


            //append data to form
            var formData = new FormData();
            formData.append('a_first', JSON.stringify(a_first));
            formData.append('a_second', JSON.stringify(a_second));
            formData.append('responden', JSON.stringify(responden));

            //disabled button
            $('#btn').prop('disabled', true);
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu tidak dapat mengubah jawaban setelah disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Simpan!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                icon: 'info',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire('Sukses!', 'Jawaban berhasi disimpan!', 'success');

                                //clear local storage
                                localStorage.clear();

                                //redirect to home
                                window.location.href = "/";
                            }
                        },
                        error: function(errors) {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                            Swal.hideLoading();
                            $('#btn').prop('disabled', false);
                        }
                    });
                }
            })

        });


        // fungsi untuk submit semua jawaban dan data responden



    })
</script>

@endpush