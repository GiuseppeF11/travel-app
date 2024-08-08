<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Dashboard Amministrativa</h3>
                </div>
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Benvenuto, {{ Auth::user()->name }}!
                    </h1>
                    <br>
                    <p>Questa è la tua dashboard amministrativa. Da qui puoi gestire i tuoi viaggi e vedere un riepilogo delle attività.</p>
                    <a href="{{ route('admin.travels.index') }}" class="btn btn-primary">Visualizza i tuoi viaggi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
