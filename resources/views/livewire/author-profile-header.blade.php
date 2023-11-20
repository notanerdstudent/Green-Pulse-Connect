<div>
    <div class="page-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="avatar avatar-md" style="background-image: url({{$author->picture}})"></span>
          </div>
          <div class="col">
            <h2 class="page-title">{{$author->name}}</h2>
            <div class="page-subtitle">
              <div class="row">
                <div class="col-auto">
                  <a href="#" class="text-reset">@ {{$author->username}} | {{$author->authorType->name}}</a>
                </div>
                <div class="col-auto text-success">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                  </svg>
                  Active
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto d-none d-md-flex">
            <input type="file" name="file" id="changeAuthorPictureFile" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
            <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('changeAuthorPictureFile').click();">
              Change Profile Image
            </a>
          </div>
        </div>
      </div>
    </div>
</div>
