<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Kepuasan Konsumen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/bootstrap.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('landing_page/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('landing_page/css/responsive.css')}}">
    <link rel="icon" href="{{ asset('landing_page/images/fevicon.png')}}" type="image/gif" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <style>
        .table-select {
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-middle min-vh-100">
        <div class="card card-block" style="width:500px; height:100vh">
            <div class="text-center my-auto">
                <div class="">
                    <h1 class="mb-5">ORDER MENU</h1>
                </div>
                <div class="px-5">
                    <form id="form-feature" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <div class="mb-3">
                                <div class="">
                                    <label for="name">Nama Pelanggan</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="">
                                    <label>Nomor Meja</label>
                                    <div class="input-group mb-3" style="width: 100%;">
                                        <select name=" table_id" class="table-select" id="table_id" required style="width: 100% !important;">
                                            <option selected disabled>Nomor Meja</option>
                                            @foreach($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Multiple Menu Items Section -->
                            <div id="menu-items-container">
                                <div class="menu-item mb-3">
                                    <div class="">
                                        <label>Menu</label>
                                        <div class="input-group mb-3">
                                            <select name="menu_id[]" class=" menu_select" required onchange="calculateTotal()">
                                                <option selected disabled>Nama Menu</option>
                                                @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - {{$menu->price}}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" required name="quantity[]" class="form-control form-control-sm quantity" placeholder="Jumlah" required min="1" onkeyup="calculateTotal()">
                                            <button type="button" class="btn btn-sm btn-danger remove-menu-item">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add More Menu Button -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-menu-item">Tambah Menu</button>
                            </div>
                            <div class="mb-3">
                                <div class="">
                                    <label for="total">Total</label>
                                    <input type="text" disabled name="total" id="total" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <input type="hidden" id="action" value="add">
                            <input type="submit" class="btn btn-sm btn-outline-success" value="Pesan Sekarang" id="btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript files-->
    <script src="{{asset('landing_page/js/jquery.min.js')}}"></script>
    <script src="{{asset('landing_page/js/popper.min.js')}}"></script>
    <script src="{{asset('landing_page/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('landing_page/js/jquery-3.0.0.min.js')}}"></script>
    <script src="{{asset('landing_page/js/plugin.js')}}"></script>
    <script src="{{asset('landing_page/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('landing_page/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {

            //Form Submit add/update
            $('#form-feature').on('submit', function(event) {
                event.preventDefault();

                url = "{{ route('guest.order.store') }}";

                let formData = new FormData($('#form-feature')[0]);

                //Append content from quil editor

                //disabled button
                $('#btn').prop('disabled', true);
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
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
                            $('#btn').prop('disabled', false);

                            Swal.fire({
                                title: 'Order Berhasil Dibuattt',
                                text: "Apakah kamu mau memesan lagi?",
                                icon: 'success',
                                showDenyButton: true,
                                denyButtonText: "Iyaaa",
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Tidak'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "/"
                                }
                            })

                        }
                    },
                    error: function(errors) {
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                        Swal.hideLoading();
                        $('#btn').prop('disabled', false);
                    }
                });
            });



            function formatRupiah(number) {
                // Convert number to string and add thousands separator
                var numberString = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Add Rp and ,00
                return 'Rp ' + numberString;
            }

            window.calculateTotal = function() {
                // Function content...
                let total = 0;
                document.querySelectorAll('.menu-item').forEach(function(item) {
                    const menuSelect = item.querySelector('.menu_select');
                    const quantityInput = item.querySelector('.quantity');
                    const price = parseFloat(menuSelect.selectedOptions[0].getAttribute('data-price'));
                    const quantity = parseInt(quantityInput.value);

                    if (!isNaN(price) && !isNaN(quantity)) {
                        total += price * quantity;
                    }
                });
                document.getElementById('total').value = total;
            };

            // Function to calculate total price
            $('#add-menu-item').on('click', function() {
                const container = document.getElementById('menu-items-container');
                const newMenuItem = document.createElement('div');
                newMenuItem.classList.add('menu-item', 'mb-3');
                newMenuItem.innerHTML = `
            <div class="">
                <label>Menu</label>
                <div class="input-group mb-3">
                    <select name="menu_id[]" class="menu_select" required onchange="calculateTotal()" style="display: none;">
                        <option selected disabled>Nama Menu</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - {{$menu->price}}</option>
                        @endforeach
                    </select>
                    <div class="nice-select menu_select" tabindex="0">
                    <span class="current">Nama Menu</span>
                    <ul class="list">
                    <li data-value="Nama Menu" class="option selected disabled">Nama Menu</li>
                    @foreach($menus as $menu)
                    <li data-value="{{$menu->id}}" class="option">{{ $menu->name }} - {{$menu->price}}</li>
                        @endforeach
                    </ul>
                    </div>
                    <input type="number" required name="quantity[]" class="form-control form-control-sm quantity" placeholder="Jumlah" required min="1" onkeyup="calculateTotal()">
                    <button type="button" class="btn btn-sm btn-danger remove-menu-item">Hapus</button>
                </div>
            </div>
        `;
                container.appendChild(newMenuItem);

                // Add event listener to remove button
                newMenuItem.querySelector('.remove-menu-item').addEventListener('click', function() {
                    container.removeChild(newMenuItem);
                    calculateTotal();
                });


            });

        });
    </script>
</body>

</html>