const linksCapitulos = ["cap1.html", "cap2.html", "cap3.html", "cap4.html", "cap5.html", "cap6.html", "cap7.html", "cap8.html", "cap9.html", "cap10.html", "cap11.html", "cap12.html", "cap13.html"];

function buscar(termo) {
    termo = termo.toLowerCase();
    return linksCapitulos.filter(link => link.toLowerCase().includes(termo));
}

function redirecionarBusca() {
    const termoBusca = document.getElementById('termoBusca').value;
    window.location.href = `busca.php?termoBusca=${termoBusca}`;
}