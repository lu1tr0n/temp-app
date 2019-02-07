<div class="container">
  <div class="row">
    <div class="col"></div>
    <div class="col-6">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Name</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $data['name'] ?>">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Username</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $data['username']; ?>">
        </div> 

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Password</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>         

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Email</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $data['email']; ?>">
        </div>

        <div class="input-group m3">
            <button type="button" class="btn btn-primary">Update profile</button> 
        </div>
    </div>
    <div class="col"></div>
  </div>
</div>