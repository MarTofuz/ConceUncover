@extends('layouts.nav&SideBar')


@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/stadistic.css') }}">
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
    <div>
        <form method="GET" action="{{ route('viewStatisticsSucursal', ['id' => $sucursal->id]) }}">
            @csrf
            <label for="month_filter">Seleccionar Mes:</label>
            <select name="month_filter" id="month_filter">
                @foreach($monthlyVisits as $visit)
                <option value="{{ $visit->month }}">{{ $visit->month_year }}</option>
                @endforeach
            </select>
            <button type="submit">Filtrar</button>
        </form>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var labels = {!! json_encode($monthlyVisits->pluck('month_year')) !!};
    var data = {!! json_encode($monthlyVisits->pluck('visit_count')) !!};

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Visitas por mes',
                data: data,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Función para actualizar el gráfico con datos filtrados por mes
    function updateChart(selectedMonth) {
        $.ajax({
            url: '/profileShop/' + {{ $sucursal->id }} + '/statistics/filter',
            method: 'GET',
            data: { month_filter: selectedMonth },
            success: function(data) {
                // Actualizar datos del gráfico
                myChart.data.labels = data.labels;
                myChart.data.datasets[0].data = data.data;
                myChart.update();
            },
            error: function(error) {
                console.error('Error al obtener datos del servidor:', error);
            }
        });
    }

    // Manejar cambios en el mes seleccionado
    $('#month_filter').change(function() {
        var selectedMonth = $(this).val();
        updateChart(selectedMonth);
    });
</script>
@endsection
