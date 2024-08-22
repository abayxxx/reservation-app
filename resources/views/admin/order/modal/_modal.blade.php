<div class="modal fade modal-flex" id="modal-feature" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">
                    Tambah Menu
                </h4>
            </div>
            <div class="modal-body">
                <form id="form-feature" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="name">Nama Pelanggan</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label>Nomor Meja</label>
                                <div class="input-group mb-3">
                                    <select name="table_id" class="form-control" id="table_id" required>
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
                                <div class="form-group">
                                    <label>Menu</label>
                                    <div class="input-group mb-3">
                                        <select name="menu_id[]" class="form-control menu_select" required onchange="calculateTotal()">
                                            <option selected disabled>Nama Menu</option>
                                            @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - {{$menu->price}}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" required name="quantity[]" class="form-control form-control-sm quantity" placeholder="Jumlah" required min="1" onkeyup="calculateTotal()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add More Menu Button -->
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-sm btn-primary" id="add-menu-item">Tambah Menu</button>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" disabled name="total" id="total" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" val="add">
                        <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Add and Remove Menu Items -->
<script>
    document.getElementById('add-menu-item').addEventListener('click', function() {
        const container = document.getElementById('menu-items-container');
        const newMenuItem = document.createElement('div');
        newMenuItem.classList.add('menu-item', 'mb-3');
        newMenuItem.innerHTML = `
            <div class="form-group">
                <label>Menu</label>
                <div class="input-group mb-3">
                    <select name="menu_id[]" class="form-control menu_select" required onchange="calculateTotal()">
                        <option selected disabled>Nama Menu</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - {{$menu->price}}</option>
                        @endforeach
                    </select>
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
</script>