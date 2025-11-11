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

    // ===================== Página de Produtos =====================
    if (document.body.classList.contains("page-produtos")) {
        const productList = document.getElementById("product-list");
        const filter = document.getElementById("filter");
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

                if (!USUARIO_LOGADO) {
                    alert("Você precisa estar logado para adicionar um produto aos favoritos!");
                    return;
                }

                const produtoId = Number(button.getAttribute("data-produto-id"));
                button.classList.toggle('active');

                if (!favoritos.includes(produtoId)) favoritos.push(produtoId);
                else {
                    const index = favoritos.indexOf(produtoId);
                    if (index > -1) favoritos.splice(index, 1);
                }

                fetch("controllers/Favoritos_ajax.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `acao=${favoritos.includes(produtoId) ? "adicionar" : "remover"}&produto_id=${produtoId}`
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message || "Erro ao atualizar favorito!");
                        button.classList.toggle('active');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Ocorreu um erro ao atualizar os favoritos.");
                    button.classList.toggle('active');
                });

                return;
            }

            // -------- Comprar Agora --------
            const btnComprarAgora = e.target.closest(".btn-comprar-agora");
            if (btnComprarAgora) {
                e.preventDefault();

                if (!USUARIO_LOGADO) {
                    alert("Você precisa estar logado para comprar!");
                    return;
                }

                const card = btnComprarAgora.closest(".produto-item");
                const produtoId = card.getAttribute("data-produto-id");

                fetch("controllers/carrinho_ajax.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `acao=adicionar&produto_id=${produtoId}`
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert("Erro ao adicionar ao carrinho!");
                        console.error(data);
                    } else {
                        window.location.href = "carrinho.php";
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Ocorreu um erro ao processar a compra.");
                });
            }
        });
    }
});
