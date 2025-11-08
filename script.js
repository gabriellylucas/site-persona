document.addEventListener("DOMContentLoaded", function () {

    // ===================== Navbar =====================
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link:not(.pedido-btn)");
    const navContainer = document.querySelector(".navbar-nav");

    if (navContainer) {
        const navUnderline = document.createElement("span");
        navUnderline.classList.add("nav-underline");
        navContainer.appendChild(navUnderline);

        function setUnderlineToElement(el) {
            const rect = el.getBoundingClientRect();
            const containerRect = navContainer.getBoundingClientRect();
            const underlineWidth = rect.width * 0.8;
            const underlineLeft = rect.left - containerRect.left + (rect.width - underlineWidth) / 2;
            navUnderline.style.width = `${underlineWidth}px`;
            navUnderline.style.left = `${underlineLeft}px`;
        }

        let currentPage = window.location.pathname.split("/").pop() || "index.php";

        navLinks.forEach(link => {
            const href = link.getAttribute("href");
            if (href && href.includes(currentPage)) link.classList.add("active");

            link.addEventListener("mouseenter", () => setUnderlineToElement(link));
            link.addEventListener("mouseleave", () => {
                const active = document.querySelector(".navbar-nav .nav-link.active");
                if (active) setUnderlineToElement(active);
                else navUnderline.style.width = 0;
            });
            link.addEventListener("click", () => {
                navLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");
                setUnderlineToElement(link);
            });
        });

        const activeLink = document.querySelector(".navbar-nav .nav-link.active");
        if (activeLink) setUnderlineToElement(activeLink);
    }

    // ===================== Perma-hover =====================
    document.querySelectorAll(".perma-hover").forEach(btn => btn.classList.add("hovered"));

    // ===================== Página de Produtos =====================
    if (document.body.classList.contains("page-produtos")) {
        const productList = document.getElementById("product-list");
        const filter = document.getElementById("filter");
        const numeroWhatsApp = "5544988563181";
        const productCards = document.querySelectorAll('.produto-item');
        const favoritos = window.favoritos || [];

        function renderProducts(categoryFilter = "todos", ingredientFilter = "todos") {
            let hasVisibleProducts = false;
            const noProductMessage = document.getElementById('no-product-message');
            if (noProductMessage) noProductMessage.remove();

            const ingredientFilterLower = ingredientFilter.toLowerCase().trim();

            productCards.forEach(card => {
                const categoria = (card.getAttribute('data-categoria') || "").toLowerCase();
                const nomeProduto = (card.getAttribute('data-nome') || "").toLowerCase();

                const showByCategory = categoryFilter === "todos" || categoria === categoryFilter.toLowerCase();
                const showByIngredient = ingredientFilterLower === "todos" || nomeProduto.includes(ingredientFilterLower);

                card.style.display = (showByCategory && showByIngredient) ? 'block' : 'none';
                if (showByCategory && showByIngredient) hasVisibleProducts = true;

                // Atualiza o estado do coração
                const heartBtn = card.querySelector(".favorite-btn");
                if (heartBtn) {
                    if (favoritos.includes(Number(card.getAttribute("data-produto-id")))) {
                        heartBtn.classList.add("active");
                    } else {
                        heartBtn.classList.remove("active");
                    }
                }
            });

            if (!hasVisibleProducts) {
                const messageDiv = document.createElement('div');
                messageDiv.id = 'no-product-message';
                messageDiv.className = 'col-12 text-center';
                messageDiv.innerHTML = `<p>Nenhum produto encontrado nesta categoria/ingrediente.</p>`;
                productList.appendChild(messageDiv);
            }
        }

        if (filter) {
            filter.addEventListener("change", () => renderProducts("todos", filter.value));
        }

        ["bolos", "docinhos", "sobremesas", "bolos-personalizados"].forEach(cat => {
            const el = document.getElementById(`filtro-${cat}`);
            if (el) el.addEventListener("click", () => {
                renderProducts(cat, filter ? filter.value : "todos");
                if (filter) filter.value = "todos";
            });
        });

        renderProducts("todos", "todos");

        // ===================== Eventos de Clique =====================
        document.body.addEventListener("click", function (e) {

            // -------- Favoritos --------
const button = e.target.closest(".favorite-btn");
if (button) {
    e.preventDefault();

    // ---------------- Verifica se está logado ----------------
    if (!USUARIO_LOGADO) {
        alert("Você precisa estar logado para favoritar um produto!");
        return; // Interrompe o resto do código
    }

    const produtoId = Number(button.getAttribute("data-produto-id"));

    // Alterna o preenchimento rosa via classe
    button.classList.toggle('active');

    // Atualiza o array de favoritos
    if (!favoritos.includes(produtoId)) favoritos.push(produtoId);
    else {
        const index = favoritos.indexOf(produtoId);
        if (index > -1) favoritos.splice(index, 1);
    }

    // Envia para o servidor
    fetch("controllers/Favoritos_ajax.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `acao=${favoritos.includes(produtoId) ? "adicionar" : "remover"}&produto_id=${produtoId}`
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert(data.message || "Erro ao atualizar favorito!");
            button.classList.toggle('active'); // Reverte se der erro
        }
    })
    .catch(err => {
        console.error(err);
        alert("Ocorreu um erro ao atualizar os favoritos.");
        button.classList.toggle('active'); // Reverte se der erro
    });

    return;
}


            // -------- Pedido via WhatsApp --------
            const btnEuQuero = e.target.closest(".btn-eu-quero");
            if (btnEuQuero) {
                e.preventDefault();
                const card = btnEuQuero.closest(".produto-item");
                const produtoNome = card.querySelector(".card-title").innerText;
                const categoria = (card.getAttribute("data-categoria") || "").toLowerCase();

                let mensagem = `Olá! Gostaria de encomendar `;
                if (categoria.includes("bolo")) mensagem += `o bolo de ${produtoNome}, por favor.`;
                else if (categoria.includes("docinho")) mensagem += `os docinhos de ${produtoNome}, por favor.`;
                else if (categoria.includes("sobremesa")) mensagem += `a sobremesa de ${produtoNome}, por favor.`;
                else mensagem += `${produtoNome}, por favor.`;

                fetch("controllers/criar_pedido.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `produto_nome=${encodeURIComponent(produtoNome)}`
                })
                    .then(res => res.json())
                    .then(data => {
                        if (!data.success) {
                            alert("Erro ao criar pedido!\nDetalhes: " + (data.error || "Sem detalhes"));
                            console.log(data);
                        } else {
                            window.open(`https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`, "_blank");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Erro ao processar pedido.");
                    });
            }
        });
    }
});
