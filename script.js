document.addEventListener("DOMContentLoaded", function () {
  const permaButton = document.querySelector(".perma-hover");

  if (permaButton) {
    permaButton.addEventListener("mouseenter", () => {
      permaButton.classList.add("hovered");
    });
  }
});

const cakes = [
  { id: 1, name: "Chocomix com Morangos", img: "", ingredient: "morango" },
  { id: 2, name: "Bolo Fini Dentaduras", img: "https://i.imgur.com/ncZyEYI.png", ingredient: "fini" },
  { id: 3, name: "Bolo Fini Beijos", img: "https://i.imgur.com/mwya6w2.png", ingredient: "fini" },
  { id: 4, name: "Delícia de Leite com Abacaxi ", img: "https://i.imgur.com/AD2yUUb.png", ingredient: "abacaxi" },
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

