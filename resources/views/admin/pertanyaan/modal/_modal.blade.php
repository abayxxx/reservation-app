<div class="modal fade modal-flex" id="modal-feature" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">
                    Tambah User
                </h4>

            </div>
            <div class="modal-body">
                <form id="form-feature" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="kode_atribut">Kode Atribut</label>
                                <input type="text" name="kode_atribut" id="kode_atribut" required class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="pertanyaan">Pertanyaan</label>
                                <input type="text" name="pertanyaan" id="pertanyaan" required class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="kriteria_id">Kriteria</label>
                                <select name="kriteria_id" id="kriteria_id" class="form-control form-control-sm">
                                    <option value="" disabled selected>Pilih</option>
                                    @foreach ($kriteria as $item)
                                    <option value="{{$item->id}}">{{$item->kriteria}}</option>
                                    @endforeach
                                </select>
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