@extends('layouts.base')

@section('title', 'Strona główna')

@section('body')
    <body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <!-- Toggler -->
            <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            <!-- User -->
            <div class="navbar-user">

                <!-- Dropdown -->
                <div class="dropdown">

                    <!-- Toggle -->
                    <a href="#" class="avatar avatar-sm dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- https://cdn.discordapp.com/avatars/412867223925948428/f3242bdaf443ffdfc793385deb6661d6.png?size=2048 -->
                        <img src="{{ $profilePicture }}" alt="..." class="avatar-img rounded-circle">
                    </a>

                    <!-- Menu
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="profile-posts.html" class="dropdown-item"><span class="fe fe-lock"></span> Panel administratora</a>
                        <a href="#" class="dropdown-item"><span class="fe fe-eye"></span> Sprawdź podania</a>
                        <hr class="dropdown-divider">
                        <a href="sign-in.html" class="dropdown-item"><span class="fe fe-logout"></span> Wyloguj się</a>
                    </div> -->

                </div>

            </div>

            <!-- Collapse -->
            <div class="collapse navbar-collapse mr-auto order-lg-first" id="navbar">

                <!-- Navigation -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <img src="assets/img/logo.png" class="navbar-brand-img">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/">
                            Strona główna
                        </a>
                    </li>
                    @if($applications->first() != null && $applications->first()->state != 0 && $applications->first()->state != 2 && $applications->first()->state != 3)
                        <li class="nav-item">
                            <a class="nav-link" href="/new">
                                Napisz podanie
                            </a>
                        </li>
                    @endif
                    <!--<li class="nav-item">
                        <a class="nav-link" href="/help">
                            Pomoc
                        </a>
                    </li>-->
                </ul>

            </div>

        </div>
    </nav>

    <div class="main-content">

        <div class="header bg-dark pb-5">
            <div class="container">
                <div class="header-body">
                    <div class="row align-items-end">

                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle text-secondary">
                                Przegląd
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title text-white">
                                Status podania
                            </h1>

                        </div>
                    </div> <!-- / .row -->
                </div> <!-- / .header-body -->

                <!-- Footer -->
                <div class="header-footer">

                    @if($applications->count() > 0)
                        @foreach($applications as $application)
                        <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                            <div class="card-body">

                                <!-- List -->
                                <ul class="list-group list-group-lg list-group-flush list my--4">
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col ml--2">

                                                <!-- Title -->
                                                @if($application->state == 1337)
                                                    <h4>Tryb Developerski</h4>
                                                @elseif($application->state == 0 or $application->state == 1 or $application->state == 2 or $application->state == 3)
                                                    <h4>Aplikacja na Whitelistę</h4>
                                                @endif
                                                <!-- Text -->
                                                <p class="card-text text-muted mb-1">
                                                @if($application->state == 0)
                                                    <span class="badge badge-soft-primary my-2" style="font-size: 14px;"><i class="fe fe-clock"></i> W trakcie sprawdzania</span><br>
                                                    Ten status oznacza, że dostaliśmy Twoją aplikację i zostanie ona sprawdzona wkrótce.<br>
                                                    Maksymalnie trwa to do 7 dni roboczych, chociaż zazwyczaj trwa to nieco krócej.<br>
                                                    Uzbrój się w cierpliwość - jeśli wszystko poszło dobrze, to dołączysz do nas wkrótce!
                                                @elseif($application->state == 1)
                                                    <span class="badge badge-soft-danger my-2" style="font-size: 14px;"><i class="fe fe-close"></i> Odrzucona</span><br>
                                                    Ten status oznacza, że Twoja aplikacja została sprawdzona z wynikiem negatywnym.<br>
                                                    Zazwyczaj dzieje się tak, gdy Twoje podanie zawiera nieprawidłowe dane, jest przekolorowane, nie masz wymaganego wieku lub mamy inne zastrzeżenia.<br>
                                                    To nie wszystkie możliwe powody, a jedynie najbardziej pospolite - podawanie powodów indywidualnie zajęłoby za dużo czasu.<br>
                                                    Przykro nam z tego powodu. Życzymy powodzenia w przyszłości!
                                                @elseif($application->state == 2)
                                                    <span class="badge badge-soft-warning my-2" style="font-size: 14px;"><i class="fe fe-random"></i> Oczekuje na dodanie do WL</span><br>
                                                    Ten status oznacza, że Twoja aplikacja została zaakceptowana i zostaniesz wkrótce dodany do Whitelisty.<br>
                                                    Bardzo się cieszymy. Widzimy się już niedługo!
                                                @elseif($application->state == 3)
                                                    <span class="badge badge-soft-success my-2" style="font-size: 14px;"><i class="fe fe-check"></i> Przyjęta</span><br>
                                                    Ten status oznacza, że Twoja aplikacja została zaakceptowana i jesteś na naszej Whiteliście. Super!
                                                @elseif($application->state == 1337)
                                                    <span class="badge badge-soft-primary my-2" style="font-size: 14px;"><i class="fe fe-code"></i> Tryb Developerski</span><br>
                                                    Ten status oznacza, że Twoja aplikacja jest w Trybie Developerskim.<br>
                                                @endif
                                                </p>

                                                <!-- Time -->
                                                <p class="card-text small text-muted">
                                                    Podanie utworzone: {{ $application->created_at }}<br>
                                                    Ostatnia aktualizacja z naszej strony: {{ $application->updated_at }}
                                                </p>

                                            </div>
                                            @if(false)
                                                <div class="col-auto">

                                                    <!-- Button -->
                                                    <a href="/new/{{ $application->uuid }}" class="btn btn-sm btn-white">
                                                        Wybierz
                                                    </a>

                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="card card-inactive">
                            <div class="card-body text-center">

                                <!-- Image -->
                                <img src="assets/img/illustrations/scale.svg" alt="..." class="img-fluid" style="max-width: 182px;">

                                <!-- Title -->
                                <h1>
                                    Brak wysłanych podań. 😱
                                </h1>

                                <!-- Subtitle -->
                                <p class="text-muted">
                                    Aplikuj, by zobaczyć tu swoje podanie.
                                </p>

                                <!-- Button -->
                                <a href="/new" class="btn btn-primary">
                                    Napisz podanie
                                </a>

                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- JavaScript libraries -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/chart.js/dist/Chart.min.js"></script>
    <script src="assets/libs/chart.js/Chart.extension.min.js"></script>
    <script src="assets/libs/highlight/highlight.pack.min.js"></script>
    <script src="assets/libs/flatpickr/dist/flatpickr.min.js"></script>
    <script src="assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <script src="assets/libs/list.js/dist/list.min.js"></script>
    <script src="assets/libs/quill/dist/quill.min.js"></script>
    <script src="assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>

    <!-- Theme script -->
    <script src="assets/js/theme.min.js"></script>

    </body>
@endsection