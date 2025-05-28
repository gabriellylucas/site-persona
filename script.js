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

    document.getElementById('formulario').addEventListener('submit', function(event) {
      event.preventDefault();

      const nome = document.getElementById('nome').value;
      const email = document.getElementById('email').value;
      const mensagem = document.getElementById('mensagem').value;

      document.getElementById('resposta').innerHTML = `
        <div class="alert alert-success">
          Obrigado, <strong>${nome}</strong>! Sua mensagem foi enviada com sucesso.
        </div>`;

      this.reset();
    });