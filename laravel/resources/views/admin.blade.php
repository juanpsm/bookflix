@extends('layouts.auth') {{-- no se si deberia usar la misma que los users (app.blade.php) o otra, por ej "auth.blade.php" --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Te logueaste correctamente como Administrador!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection