@extends('layouts.nav&SideBar')


@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<div class="containerProfile">
    <div class="form-box">
        <h1>Reporte de Visitas</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Semana</th>
                    <th>Nombre del Usuario</th>
                    <th>Total de Visitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weeklyVisits as $visit)
                <tr>
                    <td>{{ $visit->month_year }}</td>
                    <td>{{ $visit->week_in_month }}</td>
                    <td>{{ $visit->user_name }}</td>
                    <td>{{ $visit->visit_count }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total visitas:</td>
                    <td>{{ $historicalTotal }}</td>
                </tr>
            </tfoot>
        </table>
        <br>
        <h1>Calificacion del local</h1>
        @php
        $commentCount = $sucursal->comment->count('rating');
        @endphp

        @if ($commentCount > 1)
        <p>Cantidad de Calificaciones: {{ $count }}</p>
        <p>Promedio de Evaluación: {{ $avgRating }}</p>
        @else
        <p>No hay calificaciones disponibles</p>
        @endif
    </div>
</div>
@endsection
