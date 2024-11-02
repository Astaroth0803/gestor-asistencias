@extends('layouts.app')

@section('title', 'Estadísticas')

@section('content')
    <h1>Estadísticas</h1>

    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
        <div style="width: 40%;">
            <h2>Asistencias Semanales</h2>
            <canvas id="graficoSemanal"></canvas>
        </div>

        <div style="width: 40%;">
            <h2>Asistencias Mensuales</h2>
            <canvas id="graficoMensual"></canvas>
        </div>

        <div style="width: 40%;">
            <h2>Asistencias Anuales</h2>
            <canvas id="graficoAnual"></canvas>
        </div>

        <div style="width: 40%;">
            <h2>Asistencias por Actividad</h2>
            <canvas id="graficoPorActividad"></canvas>
        </div>
    </div>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Datos de PHP en formato JavaScript
        const actividades = @json($actividades->pluck('nombre_actividad'));
        const asistenciasSemanales = @json($asistenciasSemanales);
        const asistenciasMensuales = @json($asistenciasMensuales);
        const asistenciasAnuales = @json($asistenciasAnuales);
        const asistenciasPorActividad = @json($asistenciasPorActividad);

        // Etiquetas de eje Y
        const diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        const semanasMes = ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'];
        const mesesAnio = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        // Gráfico Semanal
        const ctxSemanal = document.getElementById('graficoSemanal').getContext('2d');
        console.log("Datos asistenciasSemanales:", asistenciasSemanales);
        const graficoSemanal = new Chart(ctxSemanal, {
            type: 'bar',
            data: {
                labels: actividades,
                datasets: diasSemana.map((dia, index) => ({
                    label: dia,
                    data: asistenciasSemanales.map(item => item.total[index] || 0),  // Asumimos que `total` es un array
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
        console.log("Datos asistenciasMensuales:", asistenciasMensuales);
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
        console.log("Datos asistenciasAnuales:", asistenciasAnuales);
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
                labels: actividades,
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
            }
        });
    </script>
@endsection
