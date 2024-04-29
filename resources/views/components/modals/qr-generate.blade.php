<!-- Modal -->

<div class="modal fade" id="generateQRModal" tabindex="-1" role="dialog" aria-labelledby="generateQRModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Generate QR </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @php
                // $qrcode=;
            @endphp
            <div class="modal-body generate-qr">
                <h3 id="type">
                    Toyota
                </h3>
                <div class="qrcode_box">
                    <div class="qr_code">
                        {!! DNS2D::getBarcodeHTML('abchdeuu3455', 'QRCODE', 10, 10, 'black', true) !!}
                    </div>
                    <p id="car_number"></p>
                </div>
                <div class="qr_download">
                    <button type="button" class="btn btn-qr">Download QR</button>
                    <button type="button" class="btn btn-qrprint">Print QR</button>
                </div>
            </div>

        </div>
    </div>
</div>
