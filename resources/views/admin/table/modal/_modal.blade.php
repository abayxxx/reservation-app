<div class="modal fade modal-flex" id="modal-feature" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">
                    Tambah Meja
                </h4>

            </div>
            <div class="modal-body">
                <form id="form-feature" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="status">No Meja</label>
                                <input type="number" name="number" id="number" required class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="description" id="description" required class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <di class="form-group">
                                <label for="status">Status</label>
                                <br>
                                <label for="status">Tersedia</label>
                                <input type="radio" id="status_1" name="status" value="1">
                                <br>
                                <label for="status">Tidak Tersedia</label>
                                <input type="radio" id="status_0" name="status" value="0">

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