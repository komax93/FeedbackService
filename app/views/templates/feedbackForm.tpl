<form class="form-container" action="/save" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputLogin">Login</label>
        <input type="text"  name="login" class="form-control" id="exampleInputLogin" placeholder="Enter login">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Text</label>
        <textarea class="form-control" name="text" id="exampleTextarea" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label class="btn btn-primary" for="my-file-selector">
            <input id="my-file-selector" type="file" name="file" style="display:none;">
            <span>Choose image...</span>
            <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
        </label>
    </div>
    <button type="submit" name="submit" class="btn btn-success btn-success__send">Send</button>
    <button type="button" class="btn btn-info btn-info-preview">Preview</button>
</form>