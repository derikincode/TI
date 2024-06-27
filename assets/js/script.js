document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('errorMessage');

    // Validação simples (você pode adicionar validações mais complexas)
    if (username === 'admin' && password === 'admin') {
        alert('Login bem-sucedido!');
        errorMessage.textContent = '';
        // Redirecionar para outra página ou executar outras ações
    } else {
        errorMessage.textContent = 'Usuário ou senha incorretos.';
    }
});
