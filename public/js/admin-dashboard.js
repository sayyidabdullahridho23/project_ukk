document.addEventListener('DOMContentLoaded', function() {
    fetchUserRegistrations();
});

async function fetchUserRegistrations() {
    try {
        const response = await fetch('/admin/user-registrations');
        const data = await response.json();
        
        const dates = data.map(item => formatDate(item.date));
        const counts = data.map(item => item.count);
        
        createChart(dates, counts);
    } catch (error) {
        console.error('Error fetching user logins:', error);
    }
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    return days[date.getDay()];
}

function createChart(dates, counts) {
    const ctx = document.getElementById('chart-line');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'User Logins',
                data: counts,
                tension: 0.4,
                borderWidth: 2,
                borderColor: '#5e72e4',
                backgroundColor: 'rgba(94, 114, 228, 0.2)',
                fill: true,
                pointRadius: 3,
                pointBackgroundColor: '#5e72e4',
                pointBorderColor: '#5e72e4'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        title: function(context) {
                            return `${context[0].label}`;
                        },
                        label: function(context) {
                            return `Logins: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        borderDash: [2],
                        borderDashOffset: [2]
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        borderDash: [2],
                        borderDashOffset: [2]
                    }
                }
            }
        }
    });
} 