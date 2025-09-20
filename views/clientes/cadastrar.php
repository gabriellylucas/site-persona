<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<link rel="stylesheet" href="admin.css">

<div class="page-clientes">
    <div class="main-container">
        <div class="card card-form">
            <div class="card-header">
                <h2>Cadastrar Cliente</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome do cliente" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Digite o email do cliente" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="index.php?page=clientes_listar" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
  
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
    }

    
    .page-clientes {
        display: flex;
        justify-content: center;
        padding-top: 100px;
        padding-bottom: 50px;
    }

    
    .card-form {
        width: 90%; 
        max-width: 1400px; 
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        padding: 30px 50px;
        display: flex;
        flex-direction: column;
    }

    
    .card-header {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .card-header h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 600;
        color: #333;
    }

    

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #555;
        font-size: 1rem;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        border-color: #5C4033;
        outline: none;
    }

  
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
    }

    .form-actions .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary {
        background-color: #F28585;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #e76b6b;
    }

    .btn-secondary {
        background-color: #e0e0e0;
        color: #555;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #d4d4d4;
    }

    @media (max-width: 768px) {
        .card-form {
            width: 95%;
            padding: 20px;
        }
    }
</style>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>