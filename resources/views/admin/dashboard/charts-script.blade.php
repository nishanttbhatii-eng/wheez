<script>
document.addEventListener('DOMContentLoaded', function () {
    const baseOptions = {
        responsive: true,
        maintainAspectRatio: false,
        layout: { padding: { top: 8, bottom: 4, left: 4, right: 8 } },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    boxHeight: 12,
                    padding: 16,
                    font: { size: 12, family: 'Inter, sans-serif' },
                    color: '#475569',
                },
            },
            tooltip: {
                backgroundColor: '#1e293b',
                titleFont: { size: 13, family: 'Inter, sans-serif' },
                bodyFont: { size: 12, family: 'Inter, sans-serif' },
                padding: 10,
                cornerRadius: 8,
            },
        },
    };

    function hasChartData(values) {
        return Array.isArray(values) && values.some(function (v) { return Number(v) > 0; });
    }

    function showEmpty(wrapId, emptyId) {
        const wrap = document.getElementById(wrapId);
        const empty = document.getElementById(emptyId);
        if (wrap) wrap.classList.add('d-none');
        if (empty) empty.classList.remove('d-none');
    }

    @if($charts['staff_roles'])
    const staffValues = @json($charts['staff_roles']['values']);
    if (hasChartData(staffValues)) {
        new Chart(document.getElementById('staffRoleChart'), {
            type: 'pie',
            data: {
                labels: @json($charts['staff_roles']['labels']),
                datasets: [{
                    data: staffValues,
                    backgroundColor: ['#f2e600', '#c8c400', '#2b2b2b', '#9a9200'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }],
            },
            options: baseOptions,
        });
    } else {
        showEmpty('staffRoleChartWrap', 'staffRoleChartEmpty');
    }
    @endif

    @if($charts['user_status'])
    const statusValues = @json($charts['user_status']['values']);
    if (hasChartData(statusValues)) {
        new Chart(document.getElementById('userStatusChart'), {
            type: 'doughnut',
            data: {
                labels: @json($charts['user_status']['labels']),
                datasets: [{
                    data: statusValues,
                    backgroundColor: ['#f2e600', '#52525b'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }],
            },
            options: {
                ...baseOptions,
                cutout: '62%',
            },
        });
    } else {
        showEmpty('userStatusChartWrap', 'userStatusChartEmpty');
    }
    @endif
});
</script>
