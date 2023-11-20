<div>
    <form method="POST" wire:submit.prevent="updateDetails()">
        <div class="row">
          <div class="col-md-4">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Name" wire:model="name">
              <span class="text-danger">
                @error('name') {{$message}} @enderror
              </span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Username" wire:model="username">
                <span class="text-danger">
                    @error('username') {{$message}} @enderror
                </span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Email" disabled wire:model="email">
                <span class="text-danger">
                    @error('email') {{$message}} @enderror
                </span>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Biography</label>
          <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Content.." wire:model="biography">Biography....</textarea>

        </div>
        <button type="submit" class="btn btn-primary ms-auto">Save Changes</button>
      </form>
</div>