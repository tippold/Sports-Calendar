<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= $this->css_path ?>">
    <link rel="icon" type="image/x-icon" href="/sportradar/assets/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e91dbc0a1.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?= $this->js_path ?>"></script>

    <title><?= $this->page_title; ?></title>
</head>

<body>
<div id="sidebar">
    <nav>
        <ul>
            <a href="/sportradar/"><li><i class="far fa-calendar-alt fa-3x"></i></li></a>
            <a href="/sportradar/event/add/"><li><i class="far fa-calendar-plus fa-3x"></i></li></a>
            <a><li><i class="fas fa-cog fa-2x"></i></li></a>
        </ul>
    </nav>
</div>

<main id="contentcontainer">