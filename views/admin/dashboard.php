<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../index.php?page=login");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Painel do Admin</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


<nav class="admin-navbar">
    <h2>Lia: Bolos e Cia - Admin</h2>
    <ul class="admin-menu">
        <li><a href="index.php?page=clientes_listar">Clientes</a></li>
        <li><a href="index.php?page=produtos_listar">Produtos</a></li>
        <li><a href="index.php?page=pedidos_listar">Pedidos</a></li>
        <li><a href="index.php?page=pedido_itens_listar">Itens do Pedido</a></li>
    </ul>
</nav>



<div class="dashboard-container">
    <h1>Painel Administrativo</h1>
    <p>Visão geral e acesso rápido às principais seções.</p>
    
    <div class="dashboard-grid">
        <div class="card clientes">
            <h3>Clientes</h3>
            <p class="big-number">358</p>
            <p>Novos esta semana: 12</p>
        </div>

        <div class="card pedidos">
            <h3>Pedidos Recentes</h3>
            <p>Pedido #2024-001 • R$ 85,50 <span class="badge pendente">Pendente</span></p>
            <p>Pedido #2024-002 • R$ 85,50 <span class="badge concluido">Concluído</span></p>
        </div>

        <div class="card actions">
            <a class="btn add" href="views/admin/index.php?page=produtos_cadastrar"><i class="fa fa-plus"></i> Adicionar Novo Produto</a>
            <a class="btn" href="admin_produtos.php"><i class="fa fa-box"></i> Listar Produtos</a>
            <a class="btn" href="index.php?page=admin_categorias_list"><i class="fa fa-folder"></i> Gerenciar Categorias</a>
            <a class="btn" href="#"><i class="fa fa-gear"></i> Configurações do Site</a>
            <a class="btn sair" href="../index.php?page=sair"><i class="fa fa-sign-out-alt"></i> Sair</a>
        </div>

        <div class="card produtos">
            <h3>Produtos</h3>
            <p>Total em Catálogo: 154</p>
            <p>Novos este mês: 5</p>
        </div>

        <div class="card vendas">
            <h3>Estatísticas de Vendas</h3>
            <canvas id="salesChart" height="150"></canvas>
        </div>
    </div>
</div>


<footer class="admin-footer">
    <p>&copy; 2025 Lia: Bolos e Cia - Área Administrativa. Todos os direitos reservados.</p>
</footer>

<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI'],
        datasets: [{
            label: 'Vendas',
            data: [5, 10, 7, 15, 23],
            backgroundColor: '#e89aa2'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 5 } }
        }
    }
});
</script>

</body>
</html>
