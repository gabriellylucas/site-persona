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
      if (href && href.includes(currentPage)) {
        link.classList.add("active");
      }
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

  const permaButtons = document.querySelectorAll(".perma-hover");
  permaButtons.forEach(permaButton => {
    permaButton.classList.add("hovered");
    permaButton.addEventListener("mouseenter", () => {
      permaButton.classList.add("hovered");
    });
  });

  const cakes = [
    { name: "Creme Belga com Morango", img: "imagens/belga com morango.PNG", ingredient: ["morango", "creme belga"], categoria: "bolos" },
    { name: "Ninho com Morango", img: "imagens/ninho com morango.PNG", ingredient: ["ninho", "morango"], categoria: "bolos" },
    { name: "Dois Amores", img: "imagens/dois amores.PNG", ingredient: ["brigadeiro", "beijinho"], categoria: "bolos" },
    { name: "Chocolate", img: "imagens/bolo de chocolate.PNG", ingredient: ["chocolate"], categoria: "bolos" },
    { name: "Ninho com Chocolate", img: "imagens/ninho com chocolate.PNG", ingredient: ["ninho", "chocolate"], categoria: "bolos" },
    { name: "Creme de Amendoim ", img: "imagens/creme de ameindoim.PNG", ingredient: ["amendoim", "creme"], categoria: "bolos" }, 
    { name: "Nata com Morango ", img: "imagens/nata com morango.PNG", ingredient: ["nata", "morango"], categoria: "bolos" },
    { name: "Quatro Leites", img: "imagens/quatro leite.PNG", ingredient: ["quatro leites"], categoria: "bolos" }, 
    { name: "Creme Belga com Abacaxi e Coco", img: "imagens/belga com abacaxi e coco.PNG", ingredient: ["abacaxi", "coco", "creme belga"], categoria: "bolos" },
    { name: "Dois Amores com Maracujá ", img: "imagens/dois amores e maracuja.PNG", ingredient: ["brigadeiro", "beijinho", "maracuja"], categoria: "bolos" },
    { name: "Chocolate com Morango ", img: "imagens/chocolate com morango.PNG", ingredient: ["chocolate", "morango"], categoria: "bolos" },
    { name: "Quatro Leites com Morango", img: "imagens/quatro leite com morango.PNG", ingredient: ["quatro leites", "morango"], categoria: "bolos" },
    { name: "Creme Belga com Pêssego", img: "imagens/creme belga com pessego.PNG", ingredient: ["pessego", "creme belga"], categoria: "bolos" },
    { name: "Doce de Leite", img: "imagens/doce de leite.PNG", ingredient: ["doce de leite"], categoria: "bolos" },
    { name: "Quatro Leites com Abacaxi e Coco ", img: "imagens/quatro leite com abacaxi e coco.PNG", ingredient: ["quatro leites", "abacaxi", "coco"], categoria: "bolos" },
    { name: "Doce de Leite com Coco ", img: "imagens/doce de leite com coco.PNG", ingredient: ["doce de leite", "coco"], categoria: "bolos" },
    { name: "Chocolate com Maracujá ", img: "imagens/chocolate com maracuja.PNG", ingredient: ["chocolate", "maracuja"], categoria: "bolos" },
    { name: "Nata com Morango e Chocolate", img: "imagens/nata com morango e chocolate.PNG", ingredient: ["nata", "morango", "chocolate"], categoria: "bolos" },
    { name: "Três Leites", img: "imagens/três leites.PNG", ingredient: ["tres leites"], categoria: "bolos" },
    { name: "Prestígio", img: "imagens/prestígio.PNG", ingredient: ["coco", "chocolate"], categoria: "bolos" }, 
    { name: "Três Leites com Morango ", img: "imagens/tres leites com morango.PNG", ingredient: ["tres leites", "morango"], categoria: "bolos" },
    { name: "Creme Belga com Morango e Suspiro ", img: "imagens/creme belga com morango e suspiro.PNG", ingredient: ["morango", "suspiro", "creme belga"], categoria: "bolos" },
    { name: "Nata com Morango e Suspiro", img: "imagens/nata com morango e suspiro.PNG", ingredient: ["nata", "morango", "suspiro"], categoria: "bolos" },
    { name: "Ninho com Nutella", img: "imagens/ninho com nutella.PNG", ingredient: ["ninho", "nutella"], categoria: "bolos" },
    { name: "Ninho Trufado com Morango", img: "imagens/ninho trufado com morango.PNG", ingredient: ["ninho", "chocolate", "morango"], categoria: "bolos" },
    { name: "Quatro Leites com Chocolate", img: "imagens/quatro leite com chocolate.PNG", ingredient: ["quatro leites", "chocolate"], categoria: "bolos" },
    { name: "Creme Belga com Abacaxi", img: "imagens/belga com abacaxi.PNG", ingredient: ["abacaxi", "creme belga"], categoria: "bolos" },
    { name: "Doce de Leite com Abacaxi", img: "imagens/doce de leite com abacaxi.PNG", ingredient: ["doce de leite", "abacaxi"], categoria: "bolos" },
    { name: "Trufado de Abacaxi com Chocolate Branco", img: "imagens/trufado de abacaxi com chocolate branco.PNG", ingredient: ["abacaxi", "chocolate branco"], categoria: "bolos" },
    { name: "Maracujá com Chocolate Branco", img: "imagens/maracuja com chocolate branco.PNG", ingredient: ["maracuja", "chocolate branco"], categoria: "bolos" },
    { name: "Coco com Amêndoa", img: "imagens/Coco com Amendoa.PNG", ingredient: ["coco", "amendoa"], categoria: "bolos" },
    { name: "Chocolate com Cereja", img: "imagens/Chocolate com Cereja.PNG", ingredient: ["chocolate", "cereja"], categoria: "bolos" },
    { name: "Doce de Leite com Ameixa", img: "imagens/ameixa.PNG", ingredient: ["doce de leite", "ameixa"], categoria: "bolos" },
    { name: "Limão com Chocolate", img: "imagens/mousse de limão.PNG", ingredient: ["limao", "chocolate"], categoria: "bolos" },
    { name: "Brigadeiro", img: "imagens/brigadeiro.PNG", ingredient: ["brigadeiro"], categoria: "docinhos" },
    { name: "Beijinho", img: "imagens/beijinho.PNG", ingredient: ["coco"], categoria: "docinhos" }, 
    { name: "Churros", img: "imagens/churros.PNG", ingredient: ["doce de leite", "canela"], categoria: "docinhos" }, 
    { name: "Beijinho de Ninho com Nutella", img: "imagens/ninho com nutella docinho.PNG", ingredient: ["ninho", "nutella"], categoria: "docinhos" },
    { name: "Flor de Ninho e Nutella", img: "imagens/docinhos em flor.PNG", ingredient: ["ninho", "nutella"], categoria: "docinhos" },
    { name: "Bolo de Cenoura", img: "imagens/bolo de cenoura com cobertura de chocolate.PNG", ingredient: ["cenoura", "chocolate"], categoria: "sobremesas" },
    { name: "Bolo de Laranja", img: "imagens/bolo de laranja.PNG", ingredient: ["laranja"], categoria: "sobremesas" },
    { name: "Mousse de Maracujá", img: "imagens/mousse de maracuja.PNG", ingredient: ["maracuja"], categoria: "sobremesas" },
    { name: "Pudim", img: "imagens/pudim2.PNG", ingredient: ["caramelo", "leite condensado"], categoria: "sobremesas" }, 
    { name: "Personalizado da Sua Escolha", img: "imagens/pers.PNG", ingredient: ["personalizado"], categoria: "bolos-personalizados" }, 
  ];

  const productList = document.getElementById("product-list");
  const filter = document.getElementById("filter");
  const numeroWhatsApp = "5544988563181";

  if (productList && filter) {
    function renderCakes(categoryFilter = "todos", ingredientFilter = "todos") {
      productList.innerHTML = "";
      let filteredCakes = cakes;

      if (categoryFilter !== "todos") {
        filteredCakes = filteredCakes.filter(cake => cake.categoria === categoryFilter);
      }

      if (ingredientFilter !== "todos") {
        // Agora, para cada bolo, garantimos que 'ingredient' é um array
        filteredCakes = filteredCakes.filter(cake => {
          // Verifica se cake.ingredient é um array antes de usar .includes()
          // Isso previne erros se, por algum motivo, um 'ingredient' não for um array.
          if (Array.isArray(cake.ingredient)) {
            return cake.ingredient.includes(ingredientFilter);
          }
          // Se não for um array, ou se for indefinido/nulo, não inclui no filtro
          return false;
        });
      }

      filteredCakes.forEach(cake => {
        const card = document.createElement("div");
        card.className = "col-6 col-md-3 mb-4";

        card.innerHTML = `
          <div class="card h-100 text-center">
            <div class="img-container">
              <img src="${cake.img}" alt="${cake.name}" class="card-img-top" />
            </div>
            <div class="card-body">
              <h5 class="card-title mt-2">${cake.name}</h5>
              <button class="btn-eu-quero mt-2">Eu Quero</button>
            </div>
          </div>
        `;

        const btnQuero = card.querySelector(".btn-eu-quero");
        btnQuero.addEventListener("click", () => {
          const mensagem = `Olá! Gostaria de encomendar o bolo de ${cake.name}, por favor.`;
          const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`;
          window.open(urlWhatsApp, "_blank");
        });

        productList.appendChild(card);
      });

      if (filteredCakes.length === 0) {
        productList.innerHTML = '<div class="col-12 text-center"><p>Nenhum produto encontrado nesta categoria/ingrediente.</p></div>';
      }
    }

    filter.addEventListener("change", () => {
      // É crucial que os valores dos <option> no HTML correspondam aos nomes dos ingredientes no array "cakes"
      // Se você padronizou tudo para minúsculas no array, os values no HTML também devem ser minúsculas.
      renderCakes("todos", filter.value);
    });

    const categoriaBolos = document.getElementById("filtro-bolos");
    const categoriaDocinhos = document.getElementById("filtro-docinhos");
    const categoriaSobremesas = document.getElementById("filtro-sobremesas");
    const categoriaBolosPersonalizados = document.getElementById("filtro-bolos-personalizados");

    if (categoriaBolos) {
      categoriaBolos.addEventListener("click", () => {
        renderCakes("bolos");
        filter.value = "todos";
      });
    }
    if (categoriaDocinhos) {
      categoriaDocinhos.addEventListener("click", () => {
        renderCakes("docinhos");
        filter.value = "todos";
      });
    }
    if (categoriaSobremesas) {
      categoriaSobremesas.addEventListener("click", () => {
        renderCakes("sobremesas");
        filter.value = "todos";
      });
    }
    if (categoriaBolosPersonalizados) {
      categoriaBolosPersonalizados.addEventListener("click", () => {
        renderCakes("bolos-personalizados");
        filter.value = "todos";
      });
    }

    renderCakes("todos", "todos");
  }

  const form = document.getElementById("form-contato");

  if (form) {
    const endereco = form.endereco;

    endereco.addEventListener("blur", function () {
      const valor = endereco.value.trim();
      const cepRegex = /^\d{5}-?\d{3}$/;

      if (cepRegex.test(valor)) {
        const cep = valor.replace(/\D/g, "");
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
          .then((res) => res.json())
          .then((data) => {
            if (!data.erro) {
              const enderecoCompleto = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
              endereco.value = enderecoCompleto;
              setSucesso(endereco);
            } else {
              setErro(endereco, "CEP não encontrado.");
            }
          })
          .catch(() => {
            setErro(endereco, "Erro ao consultar o CEP.");
          });
      }
    });

    form.addEventListener("submit", function (event) {
      event.preventDefault();

      let valid = true;
      const campos = [form.nome, form.email, form.telefone, form.endereco, form.assunto, form.mensagem];

      limparValidacoes();

      campos.forEach(campo => {
        const valor = campo.value.trim();
        let campoValido = true;

        if (!valor) {
          setErro(campo, "Por favor, preencha este campo.");
          valid = false;
          campoValido = false;
        }

        if (valor && campo.name === "email" && !validaEmail(valor)) {
          setErro(campo, "Por favor, informe um e-mail válido.");
          valid = false;
          campoValido = false;
        }

        if (valor && campo.name === "telefone" && !validaTelefone(valor)) {
          setErro(campo, "Informe um telefone válido (10 ou 11 dígitos).");
          valid = false;
          campoValido = false;
        }

        if (valor && campo.name === "endereco") {
          const temCEP = /^\d{5}-?\d{3}$/.test(valor);
          const partesEndereco = valor.split(",").map(p => p.trim()).filter(p => p.length >= 2);
          if (!temCEP && partesEndereco.length < 3) {
            setErro(campo, "Informe um endereço completo ou apenas o CEP.");
            valid = false;
            campoValido = false;
          }
        }

        if (campoValido) setSucesso(campo);
      });

      if (valid) {
        alert("Mensagem enviada com sucesso!");
        form.reset();
        limparValidacoes();
      }
    });

    function setErro(campo, mensagem) {
      const formGroup = campo.closest(".mb-3") || campo.closest(".col-md-4") || campo.closest(".col-md-8");
      if (!formGroup) return;

      campo.classList.add("is-invalid");
      campo.classList.remove("is-valid");

      let feedback = formGroup.querySelector(".invalid-feedback");
      if (!feedback) {
        feedback = document.createElement("div");
        feedback.className = "invalid-feedback";
        formGroup.appendChild(feedback);
      }
      feedback.textContent = mensagem;
    }

    function setSucesso(campo) {
      campo.classList.remove("is-invalid");
      campo.classList.add("is-valid");

      const formGroup = campo.closest(".mb-3") || campo.closest(".col-md-4") || campo.closest(".col-md-8");
      if (!formGroup) return;

      let feedback = formGroup.querySelector(".invalid-feedback");
      if (feedback) feedback.textContent = "";
    }

    function limparValidacoes() {
      const campos = form.querySelectorAll("input, select, textarea");
      campos.forEach(campo => {
        campo.classList.remove("is-invalid", "is-valid");
        const formGroup = campo.closest(".mb-3") || campo.closest(".col-md-4") || campo.closest(".col-md-8");
        if (formGroup) {
          const feedback = formGroup.querySelector(".invalid-feedback");
          if (feedback) feedback.textContent = "";
        }
      });
    }

    function validaEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.toLowerCase());
    }

    function validaTelefone(telefone) {
      const numeros = telefone.replace(/\D/g, "");
      return /^[0-9]+$/.test(numeros) && (numeros.length === 10 || numeros.length === 11);
    }
  }
});