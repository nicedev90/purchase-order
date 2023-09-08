<!-- warning Modal -->

<div class="modal fade" id="<?= warning_alert() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body d-flex p-4 flex-column align-items-center justify-content-center">
       <span class="card-title text-secondary  fs-3"> <?= msg_warning() ?> </span>
        <div style=" display: flex; align-items: center;justify-content: center; border-radius: 50%; width:10rem; height:10rem; background:#FFF2CA; ">
          <!-- <i class="bi bi-check-circle-fill "></i -->
          <i class="bi bi-exclamation-triangle text-warning"  style="font-size:5rem;"></i>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Success Modal -->
<div class="modal modal-lg fade" id="<?= success_alert() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body d-flex p-4 flex-column align-items-center justify-content-center">
       <span class="card-title text-success fs-3"> <?= msg_success() ?></span>
        <div style=" display: flex; align-items: center;justify-content: center; border-radius: 50%; width:20rem; height:20rem; padding:0.2rem; background:#E0F8E9; ">
          <i class="bi bi-check-circle-fill " style="font-size:10rem;color:#2ECA6A;"></i>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


