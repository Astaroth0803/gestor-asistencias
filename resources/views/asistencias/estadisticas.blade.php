@extends('layouts.app')

@section('title', 'Estadísticas')

@section('content')
    <h1 class="title">Estadísticas</h1>
    <span style="text-align: left"> 
        <p>Total de asistencias: {{ $totalAsistencias }}</p>
        <p>Asistencias de hoy: {{ $totalAsistenciasHoy }}</p>
        
    </span>
    <div class="columns is-multiline is-centered">
        <div class="column is-half">
            <h2 class="subtitle">Asistencias Semanales</h2>
            <div class="box">
                <canvas id="graficoSemanal"></canvas>
            </div>
        </div>

        <div class="column is-half">
            <h2 class="subtitle">Asistencias Mensuales</h2>
            <div class="box">
                <canvas id="graficoMensual"></canvas>
            </div>
        </div>

        <div class="column is-half">
            <h2 class="subtitle">Asistencias Anuales</h2>
            <div class="box">
                <canvas id="graficoAnual"></canvas>
            </div>
        </div>

        <div class="column is-half">
            <h2 class="subtitle">Asistencias por Actividad</h2>
            <div class="box">
                <canvas id="graficoPorActividad"></canvas>
            </div>
        </div>
    </div>

    @if(session('success'))
        <p class="notification is-success">{{ session('success') }}</p>
    @endif
    <a class="button" href="{{ route('asistencias.index') }}">Regresar</a>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Datos de PHP en formato JavaScript
        const actividades = @json($actividades->pluck('nombre_actividad'));
        const asistenciasSemanales = @json($asistenciasSemanales);
        const asistenciasMensuales = @json($asistenciasMensuales);
        const asistenciasAnuales = @json($asistenciasAnuales);
        const asistenciasPorActividad = @json($asistenciasPorActividad);

        // Etiquetas de eje Y
        const diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        const semanasMes = ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'];
        const mesesAnio = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        // Gráfico Semanal
        const ctxSemanal = document.getElementById('graficoSemanal').getContext('2d');
        const graficoSemanal = new Chart(ctxSemanal, {
            type: 'bar',
            data: {
                labels: actividades,
                datasets: diasSemana.map((dia, index) => ({
                    label: dia,
                    data: asistenciasSemanales.map(item => item.total[index] || 0),
                    backgroundColor: `rgba(54, 162, 235, ${0.2 + index * 0.1})`,
                    borderColor: `rgba(54, 162, 235, 1)`,
                    borderWidth: 1
                }))
            },
            options: {
                indexAxis: 'y'
            }
        });

        // Gráfico Mensual
        const ctxMensual = document.getElementById('graficoMensual').getContext('2d');
        const graficoMensual = new Chart(ctxMensual, {
            type: 'bar',
            data: {
                labels: actividades,
                datasets: semanasMes.map((semana, index) => ({
                    label: semana,
                    data: asistenciasMensuales.map(item => item.total[index] || 0),
                    backgroundColor: `rgba(75, 192, 192, ${0.2 + index * 0.1})`,
                    borderColor: `rgba(75, 192, 192, 1)`,
                    borderWidth: 1
                }))
            },
            options: {
                indexAxis: 'y'
            }
        });

        // Gráfico Anual
        const ctxAnual = document.getElementById('graficoAnual').getContext('2d');
        const graficoAnual = new Chart(ctxAnual, {
            type: 'bar',
            data: {
                labels: actividades,
                datasets: mesesAnio.map((mes, index) => ({
                    label: mes,
                    data: asistenciasAnuales.map(item => item.total[index] || 0),
                    backgroundColor: `rgba(153, 102, 255, ${0.2 + index * 0.1})`,
                    borderColor: `rgba(153, 102, 255, 1)`,
                    borderWidth: 1
                }))
            },
            options: {
                indexAxis: 'y'
            }
        });

        // Gráfico por Actividad
        const ctxPorActividad = document.getElementById('graficoPorActividad').getContext('2d');
const graficoPorActividad = new Chart(ctxPorActividad, {
    type: 'bar',
    data: {
        labels: actividades, // Asegúrate de que esto contiene los nombres de las actividades
        datasets: [{
            label: 'Asistencias por Actividad',
            data: asistenciasPorActividad.map(item => item.total),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    title: function(tooltipItem) {
                        // Retorna el nombre de la actividad para el tooltip
                        return actividades[tooltipItem[0].dataIndex]; // Usa el índice de la barra
                    },
                    label: function(tooltipItem) {
                        return `Total: ${tooltipItem.raw}`; // Muestra el total de asistencias
                    }
                }
            }
        },
        indexAxis: 'y' // Mantén esto si estás usando barras horizontales
    }
});
    </script>
@endsection
