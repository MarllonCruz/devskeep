<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>DevsKeep</title>

    <link rel="stylesheet" href="<?=$base;?>/assets/css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
     crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div class="logo">
            <a href="<?=$base;?>">
                DevsKeep
            </a>
        </div>
        <form class='input-search' method="GET" action="<?=$base;?>">
            <button class="search-img"><i class="fa fa-search" aria-hidden="true"></i></button>
            <input type="text" name="search" class="search-campo" placeholder="Pesquisar..." />
            <button class="search-limpar"><i class="fa fa-times" aria-hidden="true"></i></button>
        </form> 
    </header>