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
    <link rel="icon" href="icon_path" type="../logo/programmer-code-logo-in-a-modern-style-Graphics-7189077-1-copy.jpg">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <?php 
            include 'sidebar.php';
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Welcome to Dashboard</h2>
            
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