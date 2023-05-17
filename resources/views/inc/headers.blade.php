<nav class="navbar navbar-expand-lg navbar-light shadow-sm mb-5">
  <div class="container">
    <a class="navbar-brand" href="#">IKOPEN IT</a>
    <div style="margin-left: 300px" class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Plan
          </a>
          <ul class="dropdown-menu ms-4" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('plan-list') }}">Comptable</a></li>
            <li><a class="dropdown-item" href="{{ url('tiers-list') }}">Tiers</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown ms-4">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Journal
          </a>
          <ul class="dropdown-menu ms-4" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('journal') }}">Afficher Journal</a></li>
            <li><a class="dropdown-item" href="{{ url('journaux-list') }}">Codes Journaux</a></li>
            <li><a class="dropdown-item" href="{{ url('balance') }}">Balance</a></li>
            {{-- <li><a class="dropdown-item" href="{{ url('bilan') }}"> Voir le bilan </a></li> --}}
            <li><a class="dropdown-item" href="{{ url('books') }}"> Grand Livre </a></li>
          </ul>
        </li>
        <li class="nav-item ms-4">
          <a class="nav-link text-dark" href="{{ url('testE') }}">Ecriture</a>
        </li>
        <li class="nav-item ms-4">
          <a class="nav-link text-dark" href="{{ url('society-profile') }}">Profil</a>
        </li>
      </ul>
      {{-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> --}}
    </div>
  </div>
</nav>