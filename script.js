document.addEventListener("DOMContentLoaded", function () {
  const permaButton = document.querySelector(".perma-hover");

  if (permaButton) {
    permaButton.addEventListener("mouseenter", () => {
      permaButton.classList.add("hovered");
    });
  }
});

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
  { id: 14, name: "Dois Amores com Maracujá ", img: "imagens/dois amores e maracuja.PNG", ingredient: "maracujá" },
  { id: 15, name: "Chocolate com Morango ", img: "imagens/chocolate com morango.PNG", ingredient: "morango" },
  { id: 16, name: "Quatro Leite com Morango", img: "imagens/quatro leite com morango.PNG", ingredient: "morango" },
  { id: 17, name: "Creme Belga com Pêssego", img: "imagens/creme belga com pessego.PNG", ingredient: "pessego" },
  { id: 18, name: "Doce de Leite", img: "imagens/doce de leite.PNG", ingredient: "doce de leite" },
  { id: 19, name: "Quatro Leite com Abacaxi e Coco ", img: "imagens/quatro leite com abacaxi e coco.PNG", ingredient: "abacaxi" },
  { id: 19, name: "Doce de Leite com Coco ", img: "imagens/doce de leite com coco.PNG", ingredient: "coco" },
  { id: 19, name: "Chocolate com Maracujá ", img: "imagens/chocolate com maracuja.PNG", ingredient: "maracuja" },
  { id: 19, name: "Nata com Morango e Chocolate", img: "imagens/nata com morango e chocolate.PNG", ingredient: "chocolate" },
  { id: 19, name: "Três Leites", img: "imagens/três leites.PNG", ingredient: "três leites.PNG" },
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

