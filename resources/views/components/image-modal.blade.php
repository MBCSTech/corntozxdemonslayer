<!-- Open the modal using ID.showModal() method -->
{{-- <button class="btn" onclick="my_modal_1.showModal()">open modal</button> --}}
<dialog id="receipt-modal" class="modal">
  <div class="modal-box">
    <img id="receiptImage" style="display: none; max-width: 100%;" alt="Resit">
    <canvas id="receiptPdfCanvas" style="display: none; max-width: 100%;"></canvas>
    <div class="modal-action justify-between">
      <form method="dialog">
        <!-- if there is a button in form, it will close the modal -->
        <button class="btn">Close</button>
      </form>
      <a id="download-button" download href="#" class="btn btn-primary">Download</a>
    </div>
  </div>
</dialog>