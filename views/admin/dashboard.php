<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../index.php?page=login");
    exit;
}

require_once 'conexao.php'; // ajuste caminho se necessário

// DEBUG (coloque false em produção)
$debug = true;
ini_set('display_errors', $debug ? 1 : 0);
error_reporting($debug ? E_ALL : 0);

$mensagens = []; 
$total_clientes = $novos_clientes_semana = $total_produtos = $novos_produtos_mes = 0;
$pedidos_recentes = [];
$labels_json = '[]';
$data_json = '[]';

try {
    // --- CLIENTES ---
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM clientes");
    $total_clientes = (int) $stmt->fetchColumn();

    if ($pdo->query("SHOW COLUMNS FROM clientes LIKE 'data_cadastro'")->rowCount() > 0) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM clientes WHERE data_cadastro >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
        $novos_clientes_semana = (int) $stmt->fetchColumn();
    }

    // --- PRODUTOS ---
    try {
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM produtos");
        $total_produtos = (int) $stmt->fetchColumn();
    } catch (PDOException $e) {
        $total_produtos = 0;
        if ($debug) $mensagens[] = "Tabela `produtos` não encontrada.";
    }

    if ($pdo->query("SHOW COLUMNS FROM produtos LIKE 'data_cadastro'")->rowCount() > 0) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM produtos 
                             WHERE MONTH(data_cadastro) = MONTH(CURDATE()) 
                             AND YEAR(data_cadastro) = YEAR(CURDATE())");
        $novos_produtos_mes = (int) $stmt->fetchColumn();
    }

    // --- PEDIDOS RECENTES ---
    $sql = "SELECT id, produto_nome, status, data_pedido 
            FROM pedidos
            ORDER BY data_pedido DESC
            LIMIT 5";
    $stmt = $pdo->query($sql);
    $pedidos_recentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // --- VENDAS (gráfico: quantidade de pedidos por mês) ---
    $sql = "SELECT DATE_FORMAT(data_pedido, '%b') AS mes, COUNT(*) AS total_pedidos
            FROM pedidos
            WHERE data_pedido >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
            GROUP BY mes, MONTH(data_pedido)
            ORDER BY MIN(data_pedido) ASC";
    $stmt = $pdo->query($sql);
    $vendas_por_mes = $stmt->fetchAll(PDO::FETCH_ASSOC);

   $meses = ['Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar']; 
$ultimoMes = date('n'); // mês atual (1–12)
$labels = [];
$data = [];

for ($i = 5; $i >= 0; $i--) {
    $m = date('M', strtotime("-$i month"));
    $labels[] = $m;
    $encontrado = array_filter($vendas_por_mes, fn($v) => $v['mes'] === $m);
    $data[] = $encontrado ? (int)array_values($encontrado)[0]['total_pedidos'] : 0;
}

    $labels_json = json_encode($labels);
    $data_json = json_encode($data);

} catch (PDOException $e) {
    if ($debug) {
        $mensagens[] = "Erro PDO: " . $e->getMessage();
    }
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
    <style>
      .debug-area { max-width:1100px; margin: 12px auto; padding:10px 14px; background:#fff3f3; border:1px solid #f1c2c2; color:#7a1d1d; border-radius:6px; font-size:14px;}
      .badge { padding:2px 6px; border-radius:4px; font-size:12px; }
      .pendente { background:#ffc107; color:#000; }
      .concluido { background:#28a745; color:#fff; }
    </style>
</head>
<body>

<nav class="admin-navbar">
    <h2>Lia: Bolos e Cia - Admin</h2>
    <ul class="admin-menu">
        <li><a href="index.php?page=">Dashboard</a></li>
        <li><a href="index.php?page=clientes_listar">Clientes</a></li>
        <li><a href="index.php?page=produtos_listar">Produtos</a></li>
        <li><a href="index.php?page=pedidos_listar">Pedidos</a></li>
    </ul>
</nav>

<div class="dashboard-container">
    <h1>Painel Administrativo</h1>
    <p>Visão geral e acesso rápido às principais seções.</p>

    <?php if ($debug && !empty($mensagens)) : ?>
        <div class="debug-area">
            <strong>Mensagens de Debug:</strong>
            <ul>
                <?php foreach ($mensagens as $m): ?>
                    <li><?= htmlspecialchars($m); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="dashboard-grid">
        <div class="card clientes">
            <h3>Clientes</h3>
            <p class="big-number"><?= htmlspecialchars($total_clientes); ?></p>
            <p>Novos esta semana: <?= htmlspecialchars($novos_clientes_semana); ?></p>
        </div>

        <div class="card pedidos">
            <h3>Pedidos Recentes</h3>
            <?php if (count($pedidos_recentes) > 0) : ?>
                <?php foreach ($pedidos_recentes as $pedido) : 
                    $badge_class = (isset($pedido['status']) && strtolower($pedido['status']) === 'pendente') ? 'pendente' : 'concluido';
                ?>
                    <p>
                        Pedido #<?= htmlspecialchars($pedido['id']); ?> &bull; 
                        <?= htmlspecialchars($pedido['produto_nome']); ?> <br>
                        <small><?= htmlspecialchars($pedido['data_pedido']); ?></small>
                        <span class="badge <?= $badge_class; ?>"><?= htmlspecialchars(ucfirst($pedido['status'] ?? '')); ?></span>
                    </p>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nenhum pedido recente encontrado.</p>
            <?php endif; ?>
        </div>

        <div class="card actions">
    <a class="btn add" href="index.php?page=clientes_cadastrar"><i class="fa fa-user-plus"></i> Adicionar Novo Cliente</a>
  <a class="btn add" href="teste_cadastro_produto.php">
    <i class="fa fa-box"></i> Adicionar Produto</a>
    <a class="btn add" href="index.php?page=pedidos_cadastrar"><i class="fa fa-cart-plus"></i> Adicionar Pedidos</a>
   <a class="btn sair" href="index.php?page=home"><i class="fa fa-sign-out-alt"></i> Sair</a>
</div>


        <div class="card produtos">
            <h3>Produtos</h3>
            <p>Total em Catálogo: <?= htmlspecialchars($total_produtos); ?></p>
            <p>Novos este mês: <?= htmlspecialchars($novos_produtos_mes); ?></p>
        </div>

        <div class="card vendas">
            <h3>Estatísticas de Pedidos</h3>
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
        labels: <?= $labels_json; ?>,
        datasets: [{
            label: 'Pedidos',
            data: <?= $data_json; ?>,
            backgroundColor: '#e89aa2'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

</body>
</html>
