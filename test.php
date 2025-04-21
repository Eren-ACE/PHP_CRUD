<?php
// Sample data (you can replace with database data)
$stats = [
    'users' => 245,
    'sales' => 1234,
    'revenue' => '$45,670',
    'orders' => 89
];

$recent_activities = [
    ['user' => 'John Doe', 'action' => 'New order #1234', 'time' => '2 min ago'],
    ['user' => 'Jane Smith', 'action' => 'Updated profile', 'time' => '15 min ago'],
    ['user' => 'Mike Johnson', 'action' => 'Completed payment', 'time' => '30 min ago']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f0f2f5;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
            transition: all 0.3s;
        }

        .sidebar:hover {
            width: 260px;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }

        .main-content {
            margin-left: 250px;
            padding: 25px;
            flex: 1;
            transition: all 0.3s;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .activity-list {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-blue { border-left: 4px solid #3498db; }
        .card-green { border-left: 4px solid #2ecc71; }
        .card-orange { border-left: 4px solid #e67e22; }
        .card-purple { border-left: 4px solid #9b59b6; }

        .activity-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            animation: slideIn 0.5s forwards;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Dashboard</h2>
            <nav>
                <ul style="list-style: none; margin-top: 20px;">
                    <li style="padding: 10px 0;">🏠 Home</li>
                    <li style="padding: 10px 0;">📊 Analytics</li>
                    <li style="padding: 10px 0;">📈 Reports</li>
                    <li style="padding: 10px 0;">⚙️ Settings</li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Welcome to Dashboard</h1>
            
            <!-- Stats Cards -->
            <div class="stats-container">
                <?php foreach($stats as $key => $value): ?>
                <div class="stat-card card-<?= ['blue', 'green', 'orange', 'purple'][array_search($key, array_keys($stats))] ?>">
                    <h3><?= ucfirst($key) ?></h3>
                    <h2><?= $value ?></h2>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Chart -->
            <div class="chart-container">
                <h3>Sales Overview</h3>
                <canvas id="salesChart" style="width: 100%; height: 300px;"></canvas>
            </div>

            <!-- Recent Activity -->
            <div class="activity-list">
                <h3>Recent Activity</h3>
                <?php foreach($recent_activities as $activity): ?>
                <div class="activity-item">
                    <strong><?= $activity['user'] ?></strong> - <?= $activity['action'] ?>
                    <small style="display: block; color: #666;"><?= $activity['time'] ?></small>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample Chart.js implementation
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>