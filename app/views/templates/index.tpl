{include file="./header.tpl" title="Feedback"}

<div class="container main-container">
    {include file="./feedbackForm.tpl"}

    <div class="comment comment-toggle hideblock">
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="comment__email"></a>
                <a href="#" class="comment__login"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="comment__date"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="comment__text"></div>
            </div>
        </div>
    </div>

    {foreach from=$feedback item=item}
        <div class="comment">
            <div class="row">
                <div class="col-md-12">
                    <a href="/?order=email" class="comment__email">{$item.email}</a>
                    <a href="/?order=login" class="comment__login">{$item.login}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="/" class="comment__date">{$item.feed_date}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="comment__text">{$item.text}</div>
                </div>
            </div>
            {if $item.image_path != 'NULL'}
                <div class="row">
                    <div class="col-md-12">
                        <div class="comment__img">

                            <img src="/imageStorage/{$item.image_path}">

                        </div>
                    </div>
                </div>
            {/if}
        </div>
    {/foreach}
</div>

{include file="./footer.tpl"}