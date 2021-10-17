<button type="button" id="btn-create-work" class="btn btn-primary" data-toggle="modal" data-target="#createModal" style="display: none;"></button>
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="createModalLabel">Create Your Work</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-work-content">
                <label for="create-name">Your work : </label>
                <input id="create-name" type="text"> <br><br>

                <label for="select-status" class="label-create-status">Status :</label>
                <select name="status" id="select-status">
                    <?php for ($i = 1; $i <= App\Enums\WorkStatus::TOTAL_STATUS; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo ucwords(App\Enums\WorkStatus::getName($i)) ?></option>
                    <?php }  ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="created-work">Create</button>
            </div>
        </div>
    </div>
</div>
