// Weight chart initialization
function initWeightChart() {
    const ctx = document.getElementById("weightChart");
    if (!ctx) return;

    // Get data from global variables
    const labels = window.weightChartLabels || [];
    const data = window.weightChartData || [];

    new Chart(ctx, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Pembagian bobot kriteria",
                    data: data,
                    backgroundColor: [
                        "oklch(63.7% 0.237 25.331)",
                        "oklch(70.5% 0.213 47.604)",
                        "oklch(79.5% 0.184 86.047)",
                        "oklch(72.3% 0.219 149.579)",
                    ],
                    borderColor: ["oklch(0% 0 0 / 0.1)"],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        padding: 15,
                        font: {
                            size: 12,
                        },
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            var label = context.label || "";
                            if (label) {
                                label += ": ";
                            }
                            label += context.parsed.toFixed(4);
                            return label;
                        },
                    },
                },
            },
        },
    });
}

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", initWeightChart);
