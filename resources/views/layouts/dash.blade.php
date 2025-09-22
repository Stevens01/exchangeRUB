<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - ExchangeRUB')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f5ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#1a237e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar {
            transition: all 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            .overlay.active {
                display: block;
            }
        }
        
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Overlay pour mobile -->
    <div class="overlay" id="overlay"></div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidedash')

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('layouts.header')

            <!-- Contenu -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Menu toggle pour mobile
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('overlay');
        
        if (menuToggle && sidebar && overlay) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
            
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
        
        // Graphique des transactions
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('transactionChart');
            if (ctx) {
                const transactionChart = new Chart(ctx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                        datasets: [
                            {
                                label: 'RUB → FCFA',
                                data: [65, 59, 80, 81, 56, 55, 40],
                                borderColor: '#4f46e5',
                                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'FCFA → RUB',
                                data: [28, 48, 40, 19, 86, 27, 90],
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                fill: true,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
            
            // Simulation de la mise à jour des taux
            const updateButton = document.querySelector('button.bg-primary-600');
            if (updateButton) {
                updateButton.addEventListener('click', function() {
                    const rubToFcfa = document.querySelector('input[type="number"]').value;
                    const fcfaToRub = document.querySelectorAll('input[type="number"]')[1].value;
                    
                    // Mise à jour des taux dans la sidebar
                    const rateElements = document.querySelectorAll('.bg-primary-800 .flex span:last-child');
                    if (rateElements.length >= 2) {
                        rateElements[0].textContent = `1 → ${rubToFcfa}`;
                        rateElements[1].textContent = `1 → ${fcfaToRub}`;
                    }
                    
                    // Notification de succès
                    alert(`Taux mis à jour avec succès!\nRUB → FCFA: 1 → ${rubToFcfa}\nFCFA → RUB: 1 → ${fcfaToRub}`);
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>