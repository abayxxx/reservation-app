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
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label>Menu</label>
                                <div class="input-group mb-3">
                                    <select name="menu_id" class="form-control menu_select" id="menu_id" required>
                                        <option selected disabled>Nama Menu</option>
                                        @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->name }} - {{$menu->price}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="quantity">Jumlah Menu</label>
                                <input type="int" required name="quantity" id="quantity" class="form-control form-control-sm quantity">
                            </div>
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