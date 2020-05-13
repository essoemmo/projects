<!doctype html>
<title>Site Maintenance</title>
<meta charset="UTF-8">
<style>
    body {
        text-align: center;
        padding: 150px;
    }

    h1 {
        font-size: 50px;
    }

    body {
        font: 20px Helvetica, sans-serif;
        color: #333;
    }

    article {
        display: block;
        text-align: left;
        width: 650px;
        margin: 0 auto;
    }

    a {
        color: #dc8100;
        text-decoration: none;
    }

    a:hover {
        color: #333;
        text-decoration: none;
    }
</style>

<article>
    <img
        src="{{ asset(\App\Bll\Utility::getStoreSettigs()->logo) }}"
        alt="" style="width: 150px;height: 150px">
    <h1>{{ \App\Bll\Utility::getStoreSettigs()->maintenance_title }}</h1>
    <div>
        <p>{{ \App\Bll\Utility::getStoreSettigs()->maintenance_message }}</p>
        <p>&mdash; {{ \App\Bll\Utility::getStoreSettigs()->title }} {{ _i('Team') }}</p>
    </div>
</article>
