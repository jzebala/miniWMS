<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
    <a class="navbar-brand" href="/">MiniWMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav mr-auto">

            <li {!! (Request::is('/') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
                <a class="nav-link" href="/">Magazyn <span class="sr-only">(current)</span></a>
            </li>

            <li {!! (Request::is('product*') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
                <a class="nav-link" href={{ route('product.index') }}>Produkty</a>
            </li>

            <li {!! (Request::is('location*') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
                <a class="nav-link" href={{ route('location.index') }}>Lokalizacje</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Stany magazynowe</a>
                <div class="dropdown-menu" aria-labelledby="dropdown">
                    <a class="dropdown-item" href={{ route('stocklevel.discrepancy') }}>Rozbieżności</a>
                    <a class="dropdown-item" href={{ route('stocklevel.expired') }}>Stan toksyczny</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Operacje</a>
                <div class="dropdown-menu" aria-labelledby="dropdown">
                    <a class="dropdown-item" href={{ route('godhand.index') }}>Ręka Boga</a>
                    <div class="dropdown-divider"></div>
                    <a target="_blank" class="dropdown-item" href={{ route('inventoryList') }}>Lista inwentaryzacyjna</a>
                </div>
            </li>
        </ul>
    </div>

</div> <!-- ./ container -->
</nav> <!-- ./ nav -->