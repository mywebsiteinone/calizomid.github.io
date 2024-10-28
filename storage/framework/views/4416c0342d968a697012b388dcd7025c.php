<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .active {
            font-weight: bold;
            text-decoration: underline;
            border-bottom: 2px solid white;
        }
    </style>
</head>
<body class="bg-white text-black font-sans">
    <nav class="bg-blue-500 p-4 flex items-center">
        <div class="text-white text-xl font-bold flex items-center">
            <i class="fas fa-tachometer-alt mr-2"></i>
            Dashboard
        </div>
        <div class="ml-8 flex space-x-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-home mr-1"></i>
                Dashboard
            </a>
            <a href="<?php echo e(route('abalos-users.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-users mr-1"></i>
                Users
            </a>
            <a href="<?php echo e(route('abalos-categories.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-list mr-1"></i>
                Categories
            </a>
            <a href="<?php echo e(route('abalos-products.index')); ?>" class="text-white flex items-center hover:underline">
                <i class="fas fa-box mr-1"></i>
                Products
            </a>
            <a href="<?php echo e(route('abalos.chart')); ?>" class="text-white flex items-center hover:underline active">
                <i class="fas fa-chart-line mr-1"></i>
                Reports
            </a>
            <a href="<?php echo e(route('posts.home')); ?>" class="text-white flex items-center hover:underline">
    <i class="fas fa-cogs mr-1"></i>
    Manage Post
</a></div>
        <div class="ml-auto flex items-center">
            <span class="text-white mr-4">Admin: <?php echo e(Auth::user()->name); ?></span>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                Logout
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </nav>  

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Report</h1>
        <div class="flex">
            <div class="w-1/2">
                <h2 class="text-xl font-semibold mb-2">Products per Category</h2>
                <canvas id="barChart"></canvas>
            </div>
            <div class="w-1/2">
                <h2 class="text-xl font-semibold mb-2">Category Distribution</h2>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const categories = <?php echo json_encode($categories, 15, 512) ?>;
        const productCounts = <?php echo json_encode($productCounts, 15, 512) ?>;

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Number of Products per Category',
                    data: productCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Category Distribution',
                    data: productCounts,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\abalo\midact3\resources\views/abaloschristianreport.blade.php ENDPATH**/ ?>