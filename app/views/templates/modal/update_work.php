<button type="button" id="btn-update" class="btn btn-primary" data-toggle="modal" data-target="#updateModal" style="display: none;"></button>
<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateModalLabel">Update Or Delete Your Work</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-work-content">
                <label for="update-name" class="label-update">Your work : </label>
                <input id="update-name" type="text"> <br><br>

                <label for="start-date" class="label-update">Start Date : </label>
                <input type="date" id="start-date" min="<?= date('Y-m-d'); ?>"> <br><br>

                <label for="end-date" class="label-end-date">End Date : </label>
                <input type="date" id="end-date" min="<?= date('Y-m-d'); ?>"> <br><br>

                <label for="update-status" class="label-update-status">Status :</label>
                <select name="status" id="update-status">
                    <?php for ($i = 1; $i <= App\Enums\WorkStatus::TOTAL_STATUS; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo ucwords(App\Enums\WorkStatus::getName($i)) ?></option>
                    <?php }  ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit-work">Update</button>
                <button type="button" class="btn btn-danger" id="delete-work">Delete</button>
            </div>
        </div>
    </div>
</div>
