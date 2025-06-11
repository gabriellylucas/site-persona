document.addEventListener("DOMContentLoaded", function () {
  // Hover permanente no menu
  const permaButtons = document.querySelectorAll(".perma-hover");
  permaButtons.forEach(permaButton => {
    permaButton.classList.add("hovered");
    permaButton.addEventListener("mouseenter", () => {
      permaButton.classList.add("hovered");
    });
  });

  // Dados dos bolos (cake)
  const cakes = [
    { id: 1, name: "Creme Belga com Abacaxi", img: "imagens/belga com abacaxi.PNG", ingredient: "abacaxi" },
    { id: 2, name: "Creme Belga com Morango", img: "imagens/belga com morango.PNG", ingredient: "morango" },
    { id: 3, name: "Ninho com Morango", img: "imagens/ninho com morango.PNG", ingredient: "morango" },
    { id: 5, name: "Prestígio", img: "imagens/prestígio.PNG", ingredient: "prestígio" },
    { id: 6, name: "Dois Amores", img: "imagens/dois amores.PNG", ingredient: "dois amores" },
    { id: 7, name: "Doce de Leite com Abacaxi", img: "imagens/doce de leite com abacaxi.PNG", ingredient: "abacaxi" },
    { id: 8, name: "Chocolate", img: "imagens/bolo de chocolate.PNG", ingredient: "chocolate" },
    { id: 9, name: "Ninho com Chocolate", img: "imagens/ninho com chocolate.PNG", ingredient: "chocolate" },
    { id: 10, name: "Creme de Ameindoim ", img: "imagens/creme de ameindoim.PNG", ingredient: "ameindoim" },
    { id: 11, name: "Nata com Morango ", img: "imagens/nata com morango.PNG", ingredient: "morango" },
    { id: 12, name: "Quatro Leite", img: "imagens/quatro leite.PNG", ingredient: "quatro leite" },
    { id: 13, name: "Creme Belga com Abacaxi e Coco", img: "imagens/belga com abacaxi e coco.PNG", ingredient: "abacaxi" },
    { id: 14, name: "Dois Amores com Maracujá ", img: "imagens/dois amores e maracuja.PNG", ingredient: "maracuja" },
    { id: 15, name: "Chocolate com Morango ", img: "imagens/chocolate com morango.PNG", ingredient: "morango" },
    { id: 16, name: "Quatro Leite com Morango", img: "imagens/quatro leite com morango.PNG", ingredient: "morango" },
    { id: 17, name: "Creme Belga com Pêssego", img: "imagens/creme belga com pessego.PNG", ingredient: "pessego" },
    { id: 18, name: "Doce de Leite", img: "imagens/doce de leite.PNG", ingredient: "doce de leite" },
    { id: 19, name: "Quatro Leite com Abacaxi e Coco ", img: "imagens/quatro leite com abacaxi e coco.PNG", ingredient: "abacaxi" },
    { id: 20, name: "Doce de Leite com Coco ", img: "imagens/doce de leite com coco.PNG", ingredient: "coco" },
    { id: 21, name: "Chocolate com Maracujá ", img: "imagens/chocolate com maracuja.PNG", ingredient: "maracuja" },
    { id: 22, name: "Nata com Morango e Chocolate", img: "imagens/nata com morango e chocolate.PNG", ingredient: "chocolate" },
    { id: 23, name: "Três Leites", img: "imagens/três leites.PNG", ingredient: "três leites" },
    { id: 24, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  ];

  // Só cria esses elementos se existirem no HTML
  const productList = document.getElementById("product-list");
  const filter = document.getElementById("filter");

  if (productList && filter) {
    function renderCakes(selected) {
      productList.innerHTML = "";
      const filtered = selected === "todos" ? cakes : cakes.filter(cake => cake.ingredient === selected);
      filtered.forEach(cake => {
        productList.innerHTML += `
          <div class="col-md-3 mb-4">
            <div class="card h-100 text-center">
              <img src="${cake.img}" alt="${cake.name}" class="card-img-top" />
              <div class="card-body">
                <small class="text-muted">#${cake.id}</small>
                <h5 class="card-title mt-2">${cake.name}</h5>
                <button class="btn-eu-quero mt-2">Eu quero</button>
              </div>
            </div>
          </div>
        `;
      });
    }

    filter.addEventListener("change", () => {
      renderCakes(filter.value);
    });

    renderCakes("todos");
  }

  const form = document.getElementById("form-contato");

  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();

      let valid = true;

      const nome = form.nome;
      const email = form.email;
      const telefone = form.telefone;
      const endereco = form.endereco;
      const assunto = form.assunto;
      const mensagem = form.mensagem;

      limparValidacoes();

      // Verifica se pelo menos um campo foi preenchido
      const campos = [nome, email, telefone, endereco, assunto, mensagem];
      const preencheuAlgum = campos.some(campo => campo.value.trim() !== "");

      if (preencheuAlgum) {
        // Agora, TODOS os campos precisam ser preenchidos
        campos.forEach(campo => {
          if (!campo.value.trim()) {
            setErro(campo, "Por favor, preencha este campo.");
            valid = false;
          } else {
            if (campo === email && !validaEmail(email.value)) {
              setErro(email, "Por favor, informe um e-mail válido.");
              valid = false;
            } else {
              setSucesso(campo);
            }
          }
        });
      } else {
        // Se nenhum preenchido, limpa validação e impede envio
        campos.forEach(campo => limpaValidacaoCampo(campo));
        valid = false; // não deixa enviar com tudo vazio
      }

      if (valid) {
        form.submit();
      }
    });

    function setErro(campo, mensagem) {
      const formGroup = campo.closest(".mb-3, .col-md-4, .col-md-8");
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

      const formGroup = campo.closest(".mb-3, .col-md-4, .col-md-8");
      if (!formGroup) return;

      let feedback = formGroup.querySelector(".invalid-feedback");
      if (feedback) feedback.textContent = "";
    }

    function limparValidacoes() {
      const campos = form.querySelectorAll("input, select, textarea");
      campos.forEach((campo) => {
        campo.classList.remove("is-invalid");
        campo.classList.remove("is-valid");

        const formGroup = campo.closest(".mb-3, .col-md-4, .col-md-8");
        if (!formGroup) return;

        let feedback = formGroup.querySelector(".invalid-feedback");
        if (feedback) feedback.textContent = "";
      });
    }

    function limpaValidacaoCampo(campo) {
      campo.classList.remove("is-invalid");
      campo.classList.remove("is-valid");

      const formGroup = campo.closest(".mb-3, .col-md-4, .col-md-8");
      if (!formGroup) return;

      const feedback = formGroup.querySelector(".invalid-feedback");
      if (feedback) feedback.textContent = "";
    }

    function validaEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email.toLowerCase());
    }
  }
});






