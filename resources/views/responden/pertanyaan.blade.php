<div class="d-none col-lg-10 col-md-10 d-flex flex-column align-items-left justify-content-center py-5 rounded" style="background-color: #EDEADE;" id="halaman-pertanyaan">
    <div id="halaman-pertanyaan">
        @if($count > 0)
        <h4 class="mb-3" style="font-weight: 700; " id="total_pertanyaan"></h4>
        <div style="background-color: #ff9f58; width:max-content" class=" px-5 mb-4">
            <span class="text-white" style="font-weight: 700;" id="kriteria"></span>
        </div>
        <div>
            <h5 id="pertanyaan"></h5>
            <input type="hidden" id="pertanyaan_id" data-pertanyaan-id="{{$pertanyaan->id}}">
        </div>
        <div class="d-flex justify-content-around mt-4">
            <div>
                <div style="margin-bottom: 30px; margin-left: -20px">
                    <span style="font-weight: 700;">Tingkat Kinerja : </span>
                </div>
                <div>
                    <div class="form-check " style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="5" name="a_first" id="a_first" style="transform: scale(3);">
                        <label class="form-check-label" for="a_first" style="margin-left: 20px;">
                            Sangat Puas
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="4" name="a_first" id="a_first" style="transform: scale(3);">
                        <label class="form-check-label" for="a_first" style="margin-left: 20px;">
                            Puas
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="3" name="a_first" id="a_first" style="transform: scale(3);">
                        <label class="form-check-label" for="a_first" style="margin-left: 20px;">
                            Cukup Puas
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="2" name="a_first" id="a_first" style="transform: scale(3);">
                        <label class="form-check-label" for="a_first" style="margin-left: 20px;">
                            Kurang Puas
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="1" name="a_first" id="a_first" style="transform: scale(3);">
                        <label class="form-check-label" for="a_first" style="margin-left: 20px;">
                            Tidak Puas
                        </label>
                    </div>
                </div>

            </div>
            <div>
                <div style="margin-bottom: 30px; margin-left: -20px">
                    <span style="font-weight: 700;">Tingkat Harapan/Kepentingan : </span>
                </div>
                <div>
                    <div class="form-check " style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="5" name="a_second" id="a_second" style="transform: scale(3);">
                        <label class="form-check-label" for="a_second" style="margin-left: 20px;">
                            Sangat Penting
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="4" name="a_second" id="a_second" style="transform: scale(3);">
                        <label class="form-check-label" for="a_second" style="margin-left: 20px;">
                            Penting
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="3" name="a_second" id="a_second" style="transform: scale(3);">
                        <label class="form-check-label" for="a_second" style="margin-left: 20px;">
                            Cukup Penting
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="2" name="a_second" id="a_second" style="transform: scale(3);">
                        <label class="form-check-label" for="a_second" style="margin-left: 20px;">
                            Kurang Penting
                        </label>
                    </div>
                    <div class="form-check" style="margin-bottom: 30px;">
                        <input class="form-check-input" type="radio" value="1" name="a_second" id="a_second" style="transform: scale(3);">
                        <label class="form-check-label" for="a_second" style="margin-left: 20px;">
                            Tidak Penting
                        </label>
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" id="prev-question" class="btn btn-danger btn-prev">
                < Sebelumnya</button>

                    <button type="submit" id="next-question" class="btn btn-primary btn-next">Selanjutnya ></button>

        </div>
        @else
        <div class="d-flex justify-content-center">
            <h4> TIDAK ADA SURVEY KEPUASAN KONSUMEN</h4>

        </div>

        @endif
    </div>
</div>