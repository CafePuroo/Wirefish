document.getElementById("formUsuario").addEventListener("submit", function(e) {
  e.preventDefault();
  const nome = document.getElementById("nome").value;
  const email = document.getElementById("email").value;
  const senha = document.getElementById("senha").value;

  fetch("backend/usuarios_adicionar.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `nome=${encodeURIComponent(nome)}&email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`
  }).then(res => res.json())
    .then(() => {
      document.getElementById("formUsuario").reset();
      listarUsuarios();
    });
});

function listarUsuarios() {
  fetch("backend/usuarios_listar.php")
    .then(res => res.json())
    .then(data => {
      const tabela = document.getElementById("tabelaUsuarios");
      tabela.innerHTML = "";
      data.forEach(u => {
        tabela.innerHTML += `
          <tr>
            <td>${u.id_usuario}</td>
            <td>${u.nome}</td>
            <td>${u.email}</td>
            <td><button onclick="excluirUsuario(${u.id_usuario})">Excluir</button></td>
          </tr>
        `;
      });
    });
}

function excluirUsuario(id) {
  if (!confirm("Deseja excluir este usuário?")) return;

  fetch("backend/usuarios_excluir.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "id_usuario=" + id
  }).then(() => listarUsuarios());
}

listarUsuarios();
