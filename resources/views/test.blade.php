<div class="qrcode" id="qrcode">
    {!! QrCode::size(80)->generate(route('customer.feedback.view', $employee->secret)) !!}
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>


<script>
    $(document).ready(function() {
        // Wait for the QR code to load
        var qrCode = document.getElementById("qrcode");

        html2canvas(qrCode).then(function(canvas) {
            // Convert the QR code to an image and trigger download
            downloadImage(canvas.toDataURL(), "QRCode.png");
        });

        function downloadImage(uri, filename) {
            var link = document.createElement("a");

            if (typeof link.download !== "string") {
                window.open(uri);
            } else {
                link.href = uri;
                link.download = filename;
                link.target = "_blank"; // Open in a new tab
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    });
</script>