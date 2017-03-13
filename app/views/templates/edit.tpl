{include file="./header.tpl" title="Edit | {$feedback.id}"}
<div class="container main-container">
<form class="form-container" action="/edit/{$feedback.id}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputLogin">Login</label>
        <input type="text"  name="login" class="form-control" id="exampleInputLogin" value="{$feedback.login}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail" value="{$feedback.email}">
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Text</label>
        <textarea class="form-control" name="text" id="exampleTextarea" rows="3">{$feedback.text}</textarea>
    </div>
    <div class="form-group">
        <label for="visibility">Visibility</label>
        <select id="visibility" name="visibility">
            <option value="1" {if $feedback.visibility == 1}selected{/if}>Visible</option>
            <option value="0" {if $feedback.visibility == 0}selected{/if}>Disable</option>
        </select>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="exampleInputEmail">Image</label>
            <div class="form__img">
                <img src="/imageStorage/{$feedback.image_path}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="btn btn-primary" for="my-file-selector">
            <input id="my-file-selector" class="form__file" type="file" name="file" style="display:none;">
            <span>Choose image...</span>
            <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
        </label>
    </div>
    <button type="submit" name="submit" class="btn btn-success btn-success__send">Update</button>
</form>
</div>
{include file="./footer.tpl"}