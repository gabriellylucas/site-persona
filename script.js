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

        let currentPage = window.location.pathname.split("/").pop() || "index.html";

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
        const numeroWhatsApp = "5544988563181";
        const productCards = document.querySelectorAll('.produto-item');

        function renderCakes(categoryFilter = "todos", ingredientFilter = "todos") {
            let hasVisibleProducts = false;

            productCards.forEach(card => {
                const categoria = (card.getAttribute('data-categoria') || "").toLowerCase();
                const ingredientes = (card.getAttribute('data-ingredientes') || "").toLowerCase();

                const showByCategory = categoryFilter === "todos" || categoria === categoryFilter.toLowerCase();
                const showByIngredient = ingredientFilter === "todos" || ingredientes.includes(ingredientFilter.toLowerCase());

                if (showByCategory && showByIngredient) {
                    card.style.display = 'block';
                    hasVisibleProducts = true;
                } else {
                    card.style.display = 'none';
                }
            });

            const noProductMessage = document.getElementById('no-product-message');
            if (!hasVisibleProducts && !noProductMessage) {
                const messageDiv = document.createElement('div');
                messageDiv.id = 'no-product-message';
                messageDiv.className = 'col-12 text-center';
                messageDiv.innerHTML = `<p>Nenhum produto encontrado nesta categoria/ingrediente.</p>`;
                productList.appendChild(messageDiv);
            } else if (hasVisibleProducts && noProductMessage) {
                noProductMessage.remove();
            }
        }

       
        if (filter) {
            filter.addEventListener("change", () => renderCakes("todos", filter.value));
        }

        
        ["bolos", "docinhos", "sobremesas", "bolos-personalizados"].forEach(cat => {
            const el = document.getElementById(`filtro-${cat}`);
            if (el) el.addEventListener("click", () => {
                renderCakes(cat, "todos");
                if (filter) filter.value = "todos";
            });
        });

        renderCakes("todos", "todos");

       
        const favoritos = window.favoritos || [];
        productList.addEventListener("click", function (e) {
            const button = e.target.closest(".favorite-btn");
            if (button) {
                const produtoId = Number(button.getAttribute("data-produto-id"));
                const heartIcon = button.querySelector("i");
                const isFavorito = heartIcon.classList.contains("fa-solid");
                const acao = isFavorito ? "remover" : "adicionar";

                fetch("/site-persona/controllers/Favoritos_ajax.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `acao=${acao}&produto_id=${produtoId}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        heartIcon.classList.toggle("fa-solid", acao === "adicionar");
                        heartIcon.classList.toggle("fa-regular", acao === "remover");

                        if (acao === "adicionar") {
                            if (!favoritos.includes(produtoId)) favoritos.push(produtoId);
                        } else {
                            const index = favoritos.indexOf(produtoId);
                            if (index > -1) favoritos.splice(index, 1);
                        }
                    } else {
                        alert(data.message || "Erro ao atualizar favorito!");
                    }
                })
                .catch(err => console.error(err));
                return;
            }

           
const img = e.target.closest(".card-img-top");
if (img) {
    const card = img.closest(".produto-item");
    const produtoNome = card.querySelector(".card-title").innerText;
    const categoria = (card.getAttribute("data-categoria") || "").toLowerCase();

    
    let mensagem = "Olá! Gostaria de encomendar ";
    if (categoria.includes("bolo")) {
        mensagem += "o bolo " + produtoNome;
    } else if (categoria.includes("docinho")) {
        mensagem += "os docinhos " + produtoNome;
    } else if (categoria.includes("sobremesa")) {
        mensagem += "a sobremesa " + produtoNome;
    } else {
        mensagem += produtoNome;
    }

    window.open(`https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`, "_blank");
}

        });
    }
});
