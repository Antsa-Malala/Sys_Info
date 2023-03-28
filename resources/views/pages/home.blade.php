
@extends('layouts.app')
@section('content')
<body style="background: url('{{  URL::asset('assets/img/stressed-person-using-computer-at-desk.svg')  }}'); ";>
    <div class="container-fluid"> 
        <div class="container a d-flex align-items-center justify-content-center text-center">
            <div class="ap">
                <div class="text-center text-dark h3 shadow-lg p-4 caec" style="background: hsla(0, 0%, 100%, 0.95);backdrop-filter: blur(30px);">
                    <div class="h5 font-italic">
                        Bienvenue !
                        Visitez vos plans comptables
                        
                    </div>
                    <br>
                    <div class="mt-2">
                        <a href="plan-list" class="btn btn-dark">
                            Voir Mes plans comptables {{-- Asiana lien ana Mijery Plan Comptable --}}
                        </a>
                    </div>
                </div>
            </div>
            {{-- <img src="{{ URL::asset('assets/img/stressed-person-using-computer-at-desk.svg') }}" class="img-fluid" alt=""> --}}
        </div>
    </div>
</body>
@endsection