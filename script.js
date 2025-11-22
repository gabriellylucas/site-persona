document.addEventListener("DOMContentLoaded", function () {

    
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

    
    document.querySelectorAll(".perma-hover").forEach(btn => btn.classList.add("hovered"));

    
    if (document.body.classList.contains("page-produtos")) {

        const productList = document.getElementById("product-list");
        const filter = document.getElementById("filter");
        const productCards = document.querySelectorAll('.produto-item');

        
        const carrinho = window.carrinho || [];
        const USUARIO_LOGADO = typeof window.USUARIO_LOGADO !== 'undefined' && window.USUARIO_LOGADO;

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

                
                const cartBtn = card.querySelector(".favorite-btn");
                if (cartBtn) {
                    const pid = Number(card.getAttribute("data-produto-id"));
                    if (carrinho.includes(pid)) cartBtn.classList.add("active");
                    else cartBtn.classList.remove("active");
                }
            });

            if (!hasVisibleProducts) {
                const messageDiv = document.createElement('div');
                messageDiv.id = 'no-product-message';
                messageDiv.className = 'col-12 text-center';
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

        
        document.body.addEventListener("click", function (e) {

            
            const cartBtn = e.target.closest(".favorite-btn");
            if (cartBtn) {
                e.preventDefault();

                if (!USUARIO_LOGADO) {
                    alert("Você precisa estar logado para adicionar um produto ao carrinho!");
                    return;
                }

                const produtoId = Number(cartBtn.getAttribute("data-produto-id"));
            
                cartBtn.classList.toggle('active');

                let action = "adicionar";
                if (!carrinho.includes(produtoId)) {
                    carrinho.push(produtoId);
                    action = "adicionar";
                } else {
                    const idx = carrinho.indexOf(produtoId);
                    if (idx > -1) carrinho.splice(idx, 1);
                    action = "remover";
                }

                
                fetch("/site-persona/controllers/Carrinho_ajax.php", { 
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `acao=${action}&produto_id=${produtoId}`
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                    
                        alert(data.message || "Erro ao atualizar o carrinho!");
                        cartBtn.classList.toggle('active');
                        if (action === "adicionar") {
                            const idx = carrinho.indexOf(produtoId);
                            if (idx > -1) carrinho.splice(idx, 1);
                        } else {
                            carrinho.push(produtoId);
                        }
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Ocorreu um erro ao atualizar o carrinho.");
                    cartBtn.classList.toggle('active');
                    if (action === "adicionar") {
                        const idx = carrinho.indexOf(produtoId);
                        if (idx > -1) carrinho.splice(idx, 1);
                    } else {
                        carrinho.push(produtoId);
                    }
                });

                return;
            }

            
            const btnComprarAgora = e.target.closest(".btn-comprar-agora");
            if (btnComprarAgora) {
                e.preventDefault();

                if (!USUARIO_LOGADO) {
                    alert("Você precisa estar logado para comprar!");
                    return;
                }

                const card = btnComprarAgora.closest(".produto-item");
                const produtoId = Number(card.getAttribute("data-produto-id"));

            
                fetch("/site-persona/controllers/Carrinho_ajax.php", { 
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `acao=adicionar&produto_id=${produtoId}`
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message || "Erro ao adicionar ao carrinho!");
                        console.error(data);
                    } else {
                    
                        window.location.href = "/site-persona/views/clientes/carrinho.php"; 
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