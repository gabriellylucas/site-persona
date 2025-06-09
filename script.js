document.addEventListener("DOMContentLoaded", function () {
  const permaButton = document.querySelector(".perma-hover");

  if (permaButton) {
    permaButton.addEventListener("mouseenter", () => {
      permaButton.classList.add("hovered");
    });
  }
});

const cakes = [
  { id: 1, name: "Chocolate", img: "imagens/bolo de chocolate.PNG", ingredient: "chocolate" },
  { id: 2, name: "Doce de Leite", img: "imagens/bolo de doce de leite.PNG", ingredient: "doce de leite" },
  { id: 3, name: "Dois Amores", img: "imagens/bolo de dois amores.PNG", ingredient: "dois amores" },
  { id: 5, name: "Morango", img: "imagens/bolo de morango.PNG", ingredient: "morango" },
  { id: 6, name: "Chocolate com Maracuja", img: "imagens/chocolate com maracuja.PNG", ingredient: "abacaxi" },
  { id: 7, name: "Chocolate com Morango", img: "imagens/chocolate com morango.PNG", ingredient: "abacaxi" },
  { id: 8, name: "Creme Belga com Abacaxi ", img: "imagens/belga com abacaxi.PNG", ingredient: "abacaxi" },
  { id: 9, name: "Creme Belga com Pessego ", img: "imagens/creme belga com pessego.PNG", ingredient: "abacaxi" },
  { id: 10, name: "Doce de Leite com Abacaxi ", img: "imagens/doce de leite com abacaxi.PNG", ingredient: "abacaxi" },
  { id: 11, name: "Maracuja com Ameixa ", img: "imagens/maracuja e ameixa.PNG", ingredient: "abacaxi" },
  { id: 12, name: "Morango com Suspiro", img: "imagens/morango com suspiro.PNG", ingredient: "abacaxi" },
  { id: 13, name: "Nata com Morango ", img: "imagens/nata com morango.PNG", ingredient: "abacaxi" },
  { id: 14, name: "Quatro leite com Morango ", img: "imagens/quatro leite com morango.PNG", ingredient: "abacaxi" },
  { id: 15, name: "Quatro Leite ", img: "imagens/quatro leite.PNG", ingredient: "abacaxi" },
  { id: 16, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 17, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 18, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Abacaxi ", img: "imagens/IMG_8360.PNG", ingredient: "abacaxi" },
];

const productList = document.getElementById("product-list");
const filter = document.getElementById("filter");

function renderCakes(selected) {
  productList.innerHTML = "";
  const filtered = selected === "todos" ? cakes : cakes.filter(cake => cake.ingredient === selected);
  filtered.forEach(cake => {
    productList.innerHTML += `
      <div class="col-md-3 mb-4">
        <div class="card h-100 text-center">
          <img src="${cake.img}" alt="${cake.name}" class="card-img-top">
          <div class="card-body">
            <small class="text-muted">#${cake.id}</small>
            <h5 class="card-title mt-2">${cake.name}</h5>
            <button class="btn btn-banner mt-2">Eu quero</button>
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


  document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('form-contato');

  form.addEventListener('submit', (event) => {
    event.preventDefault(); 

    clearValidation();

    let isValid = true;
    const nome = form.nome.value.trim();
    const email = form.email.value.trim();
    const mensagem = form.mensagem.value.trim();

    if (nome === '') {
      showError('nome');
      isValid = false;
    }

    if (email === '' || !validateEmail(email)) {
      showError('email');
      isValid = false;
    }

    if (mensagem === '') {
      showError('mensagem');
      isValid = false;
    }

    if (isValid) {
      alert('Formulário enviado com sucesso! Obrigada pelo contato.');
      form.reset();
    }
  });

  function showError(id) {
    const input = document.getElementById(id);
    input.classList.add('is-invalid');
  }

  function clearValidation() {
    const inputs = form.querySelectorAll('.form-control');
    inputs.forEach(input => input.classList.remove('is-invalid'));
  }

  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
  }
});

