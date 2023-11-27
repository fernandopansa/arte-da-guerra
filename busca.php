<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Um clássico da literatura militar e filosófica, que ensina estratégias e princípios para vencer conflitos e desafios. Um livro de sabedoria milenar, que inspira líderes e pensadores até hoje.">
  	<meta name="google-site-verification" content="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34=">
	<title>Sun Tzu - A arte da guerra</title>
	<link rel="canonical" href="index.html">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>


	<header>

		<nav class="navbar navbar-dark bg-dark fixed-top">
			<div class="container col-11">
			  <a class="navbar-brand" href="/">Arte da Guerra</a>
			  <button class="navbar-toggler btn btn-dark" type="button" title="Capitulos" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
        Capítulos </button>
			  <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
				<div class="offcanvas-header">
				  <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Capitulos</h5>
				  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
				  <ul class="navbar-nav justify-content-end flex-grow-1 pe-2">
                    <li class="nav-item">
                      <a class="nav-link text-sm" href="vida.html">Sobre a vida de Sun Tzu</a>
                    </li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap1.html">Da avaliação</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap2.html">Do comando da Guerra</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap3.html">Da arte de vencer sem desembanhar a espada</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap4.html">Da arte da manobrar as tropas</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap5.html">Do confronto direto e indireto</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap6.html">Do cheio e do vazio</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap7.html">Da arte do confronto</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap8.html">Da arte das mudanças</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap9.html">Da importância da geografia</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap10.html">Da topografia</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap11.html">Dos nove tipos de terrenos</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap12.html">Da Pirotecnia</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link text-sm" href="cap13.html">Da Arte de semear discórdia</a>
					</li>
				  </ul>
				  <form class="d-flex mt-3" role="search">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-secondary" type="submit">Search</button>
				  </form>
				 </div>
			  </div>
			 </div>
		  </nav>

	</header>


	<main>

		<topo id="topo"></topo>
        <div class="container justify-content-center col-11">

		<?php
		function realizarBusca($termoBusca) {
			// Array de páginas disponíveis
			$BUSCA = ["index.html", "vida.html", "cap1.html", "cap2.html", "cap3.html", "cap4.html", "cap5.html", "cap6.html", "cap7.html", "cap8.html", "cap9.html", "cap10.html", "cap11.html", "cap12.html", "cap13.html"];

			// Inicializa um array para armazenar os resultados
			$resultados = [];

			// Itera sobre cada página
			foreach ($BUSCA as $pagina) {
				// Lê o conteúdo do arquivo HTML
				$conteudo = file_get_contents($pagina);

				// Encontrar trecho do parágrafo que contém a palavra exata
				$dom = new DOMDocument;
				libxml_use_internal_errors(true);
				$dom->loadHTML($conteudo);
				libxml_clear_errors();

				$xpath = new DOMXPath($dom);
				$paragrafos = $xpath->query('//p');

				// Itera sobre os parágrafos
				foreach ($paragrafos as $paragrafo) {
					// Verifica se a palavra exata está no parágrafo
					if (preg_match('/\b' . preg_quote($termoBusca, '/') . '\b/i', $paragrafo->nodeValue)) {
						// Obtém o título da página (a partir da tag <title>)
						preg_match('/<title>(.*?)<\/title>/', $conteudo, $matches);
						$titulo = isset($matches[1]) ? $matches[1] : $pagina;

						// Limita o trecho para um número fixo de caracteres
						$trecho = substr($paragrafo->nodeValue, 0, 300) . '...';

						// Adiciona os resultados
						$resultados[] = ['titulo' => $titulo, 'url' => $pagina, 'trecho' => $trecho];
						// Para a busca no parágrafo atual, pois já encontrou uma correspondência
						break;
					}
				}
			}

			return $resultados;
		}

		// Obtém o termo de busca da query string
		$termoBusca = isset($_GET['termoBusca']) ? $_GET['termoBusca'] : '';

		// Realiza a busca
		$resultados = realizarBusca($termoBusca);

		// Exibe os resultados da busca
		if (!empty($resultados)) {
			foreach ($resultados as $resultado) {
				echo '<p><a href="' . $resultado['url'] . '">' . $resultado['titulo'] . '</a><br>';
				echo $resultado['trecho'] . '</p>';
			}
		} else {
			echo '<p>Nenhum resultado encontrado para "' . $termoBusca . '".</p>';
		}
		?>



				
				<hr>
				
				<nav aria-label="Page navigation">
					<ul class="pagination justify-content-center">
					  <li class="page-item disabled">
						<a class="page-link bg-dark" style="color: aliceblue" href="#" aria-label="Previous">
						  Anterior</a></li>
					  <li class="page-item"><a class="page-link bg-dark" style="color: aliceblue; overflow: hidden;" href="#">Atual</a></li>
					  <li class="page-item"><a class="page-link bg-dark" style="color: aliceblue" href="vida.html" aria-label="Next">
						  Próxima
						</a>
					  </li>
					</ul>
				</nav>

          </div>
        
	</main>



	<footer class="container col-11">
		
		

	</footer>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  
</body>
</html>
