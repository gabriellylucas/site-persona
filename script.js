document.addEventListener("DOMContentLoaded", function () {

  const numeroWhatsApp = "5544988563181";

  const permaButtons = document.querySelectorAll(".perma-hover");
  permaButtons.forEach(permaButton => {
    permaButton.classList.add("hovered");
    permaButton.addEventListener("mouseenter", () => {
      permaButton.classList.add("hovered");
    });
  });

  
  const cakes = [
    { id: 1, name: "Creme Belga com Abacaxi", img: "imagens/belga com abacaxi.PNG", ingredient: "abacaxi" },
    { id: 2, name: "Creme Belga com Morango", img: "imagens/belga com morango.PNG", ingredient: "morango" },
    { id: 3, name: "Ninho com Morango", img: "imagens/ninho com morango.PNG", ingredient: "morango" },
    { id: 5, name: "Prestígio", img: "imagens/prestígio.PNG", ingredient: "coco" },
    { id: 6, name: "Dois Amores", img: "imagens/dois amores.PNG", ingredient: "brigadeiro" },
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
    { id: 24, name: "Três Leites com Morango ", img: "imagens/tres leites com morango.PNG", ingredient: "morango" },
    { id: 25, name: "Creme Belga com Morango e Suspiro ", img: "imagens/creme belga com morango e suspiro.PNG", ingredient: "morango" },
    { id: 26, name: "Nata com Morango e Suspiro", img: "imagens/.PNG", ingredient: "morango" },
  ];

  const productList = document.getElementById("product-list");
  const filter = document.getElementById("filter");

  if (productList && filter) {
    function renderCakes(selected) {
      productList.innerHTML = "";
      const filtered = selected === "todos" ? cakes : cakes.filter(cake => cake.ingredient === selected);

      filtered.forEach(cake => {
        const card = document.createElement("div");
        card.className = "col-md-3 mb-4";

        card.innerHTML = `
          <div class="card h-100 text-center">
            <img src="${cake.img}" alt="${cake.name}" class="card-img-top" />
            <div class="card-body">
              <small class="text-muted">#${cake.id}</small>
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
    }

    filter.addEventListener("change", () => {
      renderCakes(filter.value);
    });

    renderCakes("todos");
  }

const form = document.getElementById("form-contato");

if (form) {
  const endereco = form.endereco;

  // Evento para detectar saída do campo endereço
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

    const nome = form.nome;
    const email = form.email;
    const telefone = form.telefone;
    const assunto = form.assunto;
    const mensagem = form.mensagem;

    limparValidacoes();

    const campos = [nome, email, telefone, endereco, assunto, mensagem];

    for (let i = 0; i < campos.length; i++) {
      const campo = campos[i];
      const valor = campo.value.trim();
      let campoValido = true;

      if (!valor) {
        setErro(campo, "Por favor, preencha este campo.");
        valid = false;
        campoValido = false;
      }

      if (valor && campo.name === "email") {
        if (!validaEmail(valor)) {
          setErro(campo, "Por favor, informe um e-mail válido.");
          valid = false;
          campoValido = false;
        }
      }

      if (valor && campo.name === "telefone") {
        if (!validaTelefone(valor)) {
          setErro(campo, "Informe um telefone válido (10 ou 11 dígitos).");
          valid = false;
          campoValido = false;
        }
      }

      if (valor && campo.name === "endereco") {
        const temCEP = /^\d{5}-?\d{3}$/.test(valor);
        const partesEndereco = valor
          .split(",")
          .map((p) => p.trim())
          .filter((p) => p.length >= 2);
        const enderecoCompleto = partesEndereco.length >= 3; // rua, bairro, cidade (pode ajustar)

        if (!temCEP && !enderecoCompleto) {
          setErro(
            campo,
            "Informe um endereço completo (rua, bairro, cidade) ou apenas o CEP (ex: 12345-678)."
          );
          valid = false;
          campoValido = false;
        }
      }

      if (campoValido) {
        setSucesso(campo);
      }
    }

    if (valid) {
      alert("Mensagem enviada com sucesso!");
      form.reset();
      limparValidacoes();
    }
  });

  function setErro(campo, mensagem) {
    const formGroup =
      campo.closest(".mb-3") || campo.closest(".col-md-4") || campo.closest(".col-md-8");
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

    const formGroup =
      campo.closest(".mb-3") || campo.closest(".col-md-4") || campo.closest(".col-md-8");
    if (!formGroup) return;

    let feedback = formGroup.querySelector(".invalid-feedback");
    if (feedback) feedback.textContent = "";
  }

  function limparValidacoes() {
    const campos = form.querySelectorAll("input, select, textarea");
    campos.forEach((campo) => {
      campo.classList.remove("is-invalid");
      campo.classList.remove("is-valid");

      const formGroup =
        campo.closest(".mb-3") || campo.closest(".col-md-4") || campo.closest(".col-md-8");
      if (!formGroup) return;

      let feedback = formGroup.querySelector(".invalid-feedback");
      if (feedback) feedback.textContent = "";
    });
  }

  function validaEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
  }

  function validaTelefone(telefone) {
    const apenasNumeros = telefone.replace(/\D/g, "");
    return (
      /^[0-9]+$/.test(apenasNumeros) &&
      (apenasNumeros.length >= 10 && apenasNumeros.length <= 11)
    );
  }
}
}); 