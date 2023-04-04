<nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <a class="navbar-brand" href="#">IKOPEN IT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{url('plan-list')}}">Plan Comptable</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('tiers-list')}}">Compte Tiers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('journal')}}"> Journal </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Plus
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ url('journaux-list') }}"> Codes Journaux </a></li>
                    <li><a class="dropdown-item" href="{{ url('balance') }}"> Voir la balance </a></li>
                    <li><a class="dropdown-item" href="{{ url('bilan') }}"> Voir le bilan </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{url('society-profile')}}"> Voir le profil de la société </a></li>
                  </ul>
                </li>
                {{-- <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> --}}
              </ul>
              {{-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form> --}}
            </div>
          </div>
        </nav>
  <hr>