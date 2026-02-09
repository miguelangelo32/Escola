const carregarBtn = document.getElementById("carregar");
const reporBtn = document.getElementById("repor");
const frasesContainer = document.getElementById("frases");
const palavrasContainer = document.getElementById("palavras-caixa");
const pontuacaoSpan = document.getElementById("pontuacao");

let frasesOriginais = [];
let pontuacao = 0;
let palavrasDisponiveis = [];

const atualizarPontuacao = (valor) => {
  pontuacao = valor;
  pontuacaoSpan.textContent = String(pontuacao);
};

const baralhar = (lista) =>
  lista
    .map((item) => ({ item, ordem: Math.random() }))
    .sort((a, b) => a.ordem - b.ordem)
    .map((entrada) => entrada.item);

const limparJogo = () => {
  frasesContainer.innerHTML = "";
  palavrasContainer.innerHTML = "";
  atualizarPontuacao(0);
};

const criarPalavra = (texto) => {
  const elemento = document.createElement("div");
  elemento.className = "palavra";
  elemento.textContent = texto;
  elemento.draggable = true;
  elemento.dataset.valor = texto;

  elemento.addEventListener("dragstart", (event) => {
    event.dataTransfer.setData("text/plain", texto);
    elemento.classList.add("arrastando");
  });

  elemento.addEventListener("dragend", () => {
    elemento.classList.remove("arrastando");
  });

  return elemento;
};

const criarEspaco = (valorCorreto) => {
  const espaco = document.createElement("span");
  espaco.className = "espaco";
  espaco.dataset.correto = valorCorreto;
  espaco.textContent = "____";
  espaco.setAttribute("role", "button");
  espaco.setAttribute("aria-label", "Espaço para preencher");

  espaco.addEventListener("dragover", (event) => {
    event.preventDefault();
  });

  espaco.addEventListener("drop", (event) => {
    event.preventDefault();
    const valor = event.dataTransfer.getData("text/plain");
    if (!valor) return;

    if (espaco.dataset.preenchido === "true") {
      return;
    }

    espaco.textContent = valor;
    espaco.dataset.preenchido = "true";

    const correto = valor === valorCorreto;
    espaco.classList.remove("correto", "incorreto");
    espaco.classList.add(correto ? "correto" : "incorreto");

    if (correto) {
      atualizarPontuacao(pontuacao + 10);
    }

    const palavraElemento = palavrasContainer.querySelector(
      `.palavra[data-valor="${valor}"]`
    );
    if (palavraElemento) {
      palavraElemento.remove();
    }
  });

  return espaco;
};

const renderizarFrases = (frases) => {
  frasesContainer.innerHTML = "";
  frases.forEach((frase) => {
    const wrapper = document.createElement("div");
    wrapper.className = "frase";

    frase.partes.forEach((parte) => {
      if (parte.tipo === "texto") {
        wrapper.append(document.createTextNode(parte.valor));
      } else {
        wrapper.append(criarEspaco(parte.valor));
      }
    });

    frasesContainer.append(wrapper);
  });
};

const carregarFrases = async () => {
  limparJogo();
  try {
    const resposta = await fetch("frases.txt");
    const texto = await resposta.text();

    frasesOriginais = texto
      .split(/\r?\n/)
      .map((linha) => linha.trim())
      .filter(Boolean)
      .map((linha) => {
        const partes = [];
        const regex = /\[(.+?)\]/g;
        let ultimoIndex = 0;
        let match;

        while ((match = regex.exec(linha))) {
          if (match.index > ultimoIndex) {
            partes.push({ tipo: "texto", valor: linha.slice(ultimoIndex, match.index) });
          }
          partes.push({ tipo: "lacuna", valor: match[1] });
          ultimoIndex = match.index + match[0].length;
        }

        if (ultimoIndex < linha.length) {
          partes.push({ tipo: "texto", valor: linha.slice(ultimoIndex) });
        }

        return { partes };
      });

    palavrasDisponiveis = frasesOriginais.flatMap((frase) =>
      frase.partes
        .filter((parte) => parte.tipo === "lacuna")
        .map((parte) => parte.valor)
    );

    const palavrasBaralhadas = baralhar(palavrasDisponiveis);
    palavrasContainer.innerHTML = "";
    palavrasBaralhadas.forEach((palavra) => {
      palavrasContainer.append(criarPalavra(palavra));
    });

    renderizarFrases(frasesOriginais);
    reporBtn.disabled = false;
  } catch (erro) {
    frasesContainer.textContent = "Não foi possível carregar as frases.";
    console.error(erro);
  }
};

carregarBtn.addEventListener("click", carregarFrases);
reporBtn.addEventListener("click", carregarFrases);
