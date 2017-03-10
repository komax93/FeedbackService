<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <title>{$title|default:'Feedback'}</title>
</head>
<body>
<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Feedback.dev</a>
        </div>

        {if !isset($smarty.session.user)}
            <div id="navbar" class="navbar-collapse collapse">
                <div class="navbar-form navbar-right">
                    <a href="/user/login" class="btn btn-primary">Sign in</a>
                    <a href="/user/register" class="btn btn-success">Sign up</a>
                </div>
            </div>
        {else}
            <div id="navbar" class="navbar-collapse collapse">
                <div class="navbar-form navbar-right">
                    <a href="/user/logout" class="btn btn-success">Log out</a>
                </div>
            </div>
        {/if}
    </div>
</nav>