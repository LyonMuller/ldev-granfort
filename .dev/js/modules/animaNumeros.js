function incrementarNumero(numeroElement) {
  // Extrai o número alvo do texto do elemento, removendo caracteres não numéricos
  const total = parseInt(numeroElement.dataset.numero, 10);
  let start = 0;
  // Define um incremento baseado no valor total para garantir que a animação termine em um tempo razoável
  const incremento = Math.max(Math.floor(total / 100), 1); // Assegura um mínimo de 1 para incremento

  // Limpa qualquer intervalo existente para evitar sobreposições indesejadas
  clearInterval(numeroElement.timerId);

  numeroElement.timerId = setInterval(() => {
      start += incremento;
      if (start >= total) {
          clearInterval(numeroElement.timerId); // Limpa o intervalo quando o total é alcançado ou excedido
          numeroElement.innerText = total; // Garante que o número final seja exatamente o total
      } else {
          numeroElement.innerText = start; // Atualiza o texto do elemento com o novo valor incrementado
      }
  }, 15); // Ajusta este valor conforme necessário para alterar a velocidade da animação
}


function animaNumeros(numerosSelector, observerTargetSelector, observerClass) {
  const numeros = document.querySelectorAll(numerosSelector);
  const observerTarget = document.querySelector(observerTargetSelector);

  function handleMutation(mutationRecords, observer) {
      mutationRecords.forEach((record) => {
          if (record.target.classList.contains(observerClass)) {
              observer.disconnect(); // Para de observar após a primeira ativação.
              numeros.forEach(num => incrementarNumero(num)); // Inicia a animação dos números.
          }
      });
  }

  function setupMutationObserver() {
      const observer = new MutationObserver(handleMutation);
      observer.observe(observerTarget, { attributes: true });
  }

  function init() {
      if (numeros.length && observerTarget) {
          setupMutationObserver();
      }
  }

  init(); // Chama init para iniciar a observação e a animação.
}

