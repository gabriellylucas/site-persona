document.addEventListener("DOMContentLoaded", function () {

  const navLinks = document.querySelectorAll(".navbar-nav .nav-link:not(.pedido-btn)");
  const navContainer = document.querySelector(".navbar-nav");
  const navUnderline = document.createElement("span");
  navUnderline.classList.add("nav-underline");

  if (navContainer) {
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
    });

    navLinks.forEach(link => {
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

  const cakes = [
    { id: 1, name: "Creme Belga com Morango", img: "imagens/belga com morango.PNG", ingredient: ["morango", "creme belga"], categoria: "bolos" },
    { id: 2, name: "Ninho com Morango", img: "imagens/ninho com morango.PNG", ingredient: ["ninho", "morango"], categoria: "bolos" },
    { id: 3, name: "Dois Amores", img: "imagens/dois amores.PNG", ingredient: ["brigadeiro", "beijinho"], categoria: "bolos" },
    { id: 4, name: "Chocolate", img: "imagens/bolo de chocolate.PNG", ingredient: ["chocolate"], categoria: "bolos" },
    { id: 5, name: "Ninho com Chocolate", img: "imagens/ninho com chocolate.PNG", ingredient: ["ninho", "chocolate"], categoria: "bolos" },
    { id: 6, name: "Creme de Amendoim", img: "imagens/creme de ameindoim.PNG", ingredient: ["amendoim", "creme"], categoria: "bolos" },
    { id: 7, name: "Nata com Morango", img: "imagens/nata com morango.PNG", ingredient: ["nata", "morango"], categoria: "bolos" },
    { id: 8, name: "Quatro Leites", img: "imagens/quatro leite.PNG", ingredient: ["quatro leites"], categoria: "bolos" },
    { id: 9, name: "Creme Belga com Abacaxi e Coco", img: "imagens/belga com abacaxi e coco.PNG", ingredient: ["abacaxi", "coco", "creme belga"], categoria: "bolos" },
    { id: 10, name: "Dois Amores com Maracujá", img: "imagens/dois amores e maracuja.PNG", ingredient: ["brigadeiro", "beijinho", "maracuja"], categoria: "bolos" },
    { id: 11, name: "Chocolate com Morango", img: "imagens/chocolate com morango.PNG", ingredient: ["chocolate", "morango"], categoria: "bolos" },
    { id: 12, name: "Quatro Leites com Morango", img: "imagens/quatro leite com morango.PNG", ingredient: ["quatro leites", "morango"], categoria: "bolos" },
    { id: 13, name: "Creme Belga com Pêssego", img: "imagens/creme belga com pessego.PNG", ingredient: ["pessego", "creme belga"], categoria: "bolos" },
    { id: 14, name: "Doce de Leite", img: "imagens/doce de leite.PNG", ingredient: ["doce de leite"], categoria: "bolos" },
    { id: 15, name: "Quatro Leites com Abacaxi e Coco", img: "imagens/quatro leite com abacaxi e coco.PNG", ingredient: ["quatro leites", "abacaxi", "coco"], categoria: "bolos" },
    { id: 16, name: "Doce de Leite com Coco", img: "imagens/doce de leite com coco.PNG", ingredient: ["doce de leite", "coco"], categoria: "bolos" },
    { id: 17, name: "Chocolate com Maracujá", img: "imagens/chocolate com maracuja.PNG", ingredient: ["chocolate", "maracuja"], categoria: "bolos" },
    { id: 18, name: "Nata com Morango e Chocolate", img: "imagens/nata com morango e chocolate.PNG", ingredient: ["nata", "morango", "chocolate"], categoria: "bolos" },
    { id: 19, name: "Três Leites", img: "imagens/três leites.PNG", ingredient: ["tres leites"], categoria: "bolos" },
    { id: 20, name: "Prestígio", img: "imagens/prestígio.PNG", ingredient: ["coco", "chocolate"], categoria: "bolos" },
    { id: 21, name: "Três Leites com Morango", img: "imagens/tres leites com morango.PNG", ingredient: ["tres leites", "morango"], categoria: "bolos" },
    { id: 22, name: "Creme Belga com Morango e Suspiro", img: "imagens/creme belga com morango e suspiro.PNG", ingredient: ["morango", "suspiro", "creme belga"], categoria: "bolos" },
    { id: 23, name: "Nata com Morango e Suspiro", img: "imagens/nata com morango e suspiro.PNG", ingredient: ["nata", "morango", "suspiro"], categoria: "bolos" },
    { id: 24, name: "Ninho com Nutella", img: "imagens/ninho com nutella.PNG", ingredient: ["ninho", "nutella"], categoria: "bolos" },
    { id: 25, name: "Ninho Trufado com Morango", img: "imagens/ninho trufado com morango.PNG", ingredient: ["ninho", "chocolate", "morango"], categoria: "bolos" },
    { id: 26, name: "Quatro Leites com Chocolate", img: "imagens/quatro leite com chocolate.PNG", ingredient: ["quatro leites", "chocolate"], categoria: "bolos" },
    { id: 27, name: "Creme Belga com Abacaxi", img: "imagens/belga com abacaxi.PNG", ingredient: ["abacaxi", "creme belga"], categoria: "bolos" },
    { id: 28, name: "Doce de Leite com Abacaxi", img: "imagens/doce de leite com abacaxi.PNG", ingredient: ["doce de leite", "abacaxi"], categoria: "bolos" },
    { id: 29, name: "Trufado de Abacaxi com Chocolate Branco", img: "imagens/trufado de abacaxi com chocolate branco.PNG", ingredient: ["abacaxi", "chocolate branco"], categoria: "bolos" },
    { id: 30, name: "Maracujá com Chocolate Branco", img: "imagens/maracuja com chocolate branco.PNG", ingredient: ["maracuja", "chocolate branco"], categoria: "bolos" },
    { id: 31, name: "Coco com Amêndoa", img: "imagens/Coco com Amendoa.PNG", ingredient: ["coco", "amendoa"], categoria: "bolos" },
    { id: 32, name: "Chocolate com Cereja", img: "imagens/Chocolate com Cereja.PNG", ingredient: ["chocolate", "cereja"], categoria: "bolos" },
    { id: 33, name: "Doce de Leite com Ameixa", img: "imagens/ameixa.PNG", ingredient: ["doce de leite", "ameixa"], categoria: "bolos" },
    { id: 34, name: "Limão com Chocolate", img: "imagens/mousse de limão.PNG", ingredient: ["limao", "chocolate"], categoria: "bolos" },
    { id: 35, name: "Brigadeiro", img: "imagens/brigadeiro.PNG", ingredient: ["brigadeiro"], categoria: "docinhos" },
    { id: 36, name: "Beijinho", img: "imagens/beijinho.PNG", ingredient: ["coco"], categoria: "docinhos" },
    { id: 37, name: "Churros", img: "imagens/churros.PNG", ingredient: ["doce de leite", "canela"], categoria: "docinhos" },
    { id: 38, name: "Beijinho de Ninho com Nutella", img: "imagens/ninho com nutella docinho.PNG", ingredient: ["ninho", "nutella"], categoria: "docinhos" },
    { id: 39, name: "Flor de Ninho e Nutella", img: "imagens/docinhos em flor.PNG", ingredient: ["ninho", "nutella"], categoria: "docinhos" },
    { id: 40, name: "Bolo de Cenoura", img: "imagens/bolo de cenoura com cobertura de chocolate.PNG", ingredient: ["cenoura", "chocolate"], categoria: "sobremesas" },
    { id: 41, name: "Bolo de Laranja", img: "imagens/bolo de laranja.PNG", ingredient: ["laranja"], categoria: "sobremesas" },
    { id: 42, name: "Mousse de Maracujá", img: "imagens/mousse de maracuja.PNG", ingredient: ["maracuja"], categoria: "sobremesas" },
    { id: 43, name: "Pudim", img: "imagens/pudim2.PNG", ingredient: ["caramelo", "leite condensado"], categoria: "sobremesas" },
    { id: 44, name: "Personalizado", img: "imagens/pers.PNG", ingredient: ["personalizado"], categoria: "bolos-personalizados" }
];

  const productList = document.getElementById("product-list");
  const filter = document.getElementById("filter");
  const numeroWhatsApp = "5544988563181";
  
  const favoritos = typeof window.favoritos !== "undefined" ? window.favoritos.map(Number) : [];

  function renderCakes(categoryFilter = "todos", ingredientFilter = "todos") {
    productList.innerHTML = "";

    let filteredCakes = cakes;
    if (categoryFilter !== "todos") filteredCakes = filteredCakes.filter(cake => cake.categoria === categoryFilter);
    if (ingredientFilter !== "todos") filteredCakes = filteredCakes.filter(cake => cake.ingredient.includes(ingredientFilter));

    if (filteredCakes.length === 0) {
      productList.innerHTML = `<div class="col-12 text-center"><p>Nenhum produto encontrado nesta categoria/ingrediente.</p></div>`;
      return;
    }

    filteredCakes.forEach(cake => {
      const card = document.createElement("div");
      card.className = "col-6 col-md-3 mb-4";
      const isFav = favoritos.includes(Number(cake.id));
      card.innerHTML = `
        <div class="card h-100 text-center position-relative">
          <button class="favorite-btn position-absolute top-0 end-0 m-2" data-produto-id="${cake.id}">
            <i class="fa-${isFav ? 'solid' : 'regular'} fa-heart fs-3" style="color: pink;"></i>
          </button>
          <div class="img-container">
            <img src="${cake.img}" alt="${cake.name}" class="card-img-top" />
          </div>
          <div class="card-body">
            <h5 class="card-title mt-2">${cake.name}</h5>
            <div class="d-flex justify-content-center mt-2">
              <button class="btn-eu-quero btn btn-success">Eu Quero</button>
            </div>
          </div>
        </div>
      `;

      card.querySelector(".btn-eu-quero").addEventListener("click", () => {
        let tipo = cake.categoria === "bolos" ? "bolo de " : "";
        let mensagem = cake.categoria === "bolos-personalizados"
          ? "Olá! Gostaria de encomendar o Bolo Personalizado, por favor."
          : `Olá! Gostaria de encomendar o ${tipo}${cake.name}, por favor.`;
        window.open(`https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`, "_blank");
      });

      productList.appendChild(card);
    });
  }

  if (filter) {
    filter.addEventListener("change", () => renderCakes("todos", filter.value));
  }

  ["bolos", "docinhos", "sobremesas", "bolos-personalizados"].forEach(cat => {
    const el = document.getElementById(`filtro-${cat}`);
    if (el) el.addEventListener("click", () => {
      renderCakes(cat);
      if (filter) filter.value = "todos";
    });
  });

  renderCakes("todos", "todos");

  productList.addEventListener("click", function (e) {
    const button = e.target.closest(".favorite-btn");
    if (!button) return;

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
  });

});

