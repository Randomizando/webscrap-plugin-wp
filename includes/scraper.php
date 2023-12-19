<?php
use GuzzleHttp\Client;

function buscaNumerosMegaSena() {
    $client = new Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/mega-sena/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair os números
        preg_match_all('/<div class="lt-number.*?">(.*?)<\/div>/', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            // Retorna os números extraídos
            return array_map('trim', $matches[1]); // Limpa e retorna os números
        } else {
            return ["Números não encontrados"];
        }
    } catch (Exception $e) {
        // Tratamento de erro
        return ["Erro ao buscar números: " . $e->getMessage()];
    }
}


function buscaNumerosQuina() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/quina/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair os números da Quina
        preg_match_all('/<div class="lt-number.*?">(.*?)<\/div>/', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            // Retorna os números extraídos
            return array_map('trim', $matches[1]); // Limpa e retorna os números
        } else {
            return ["Números não encontrados"];
        }
    } catch (Exception $e) {
        return ["Erro ao buscar números: " . $e->getMessage()];
    }
}


function buscaNumerosLotofacil() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/lotofacil/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair os números da Lotofácil
        preg_match_all('/<div class="lt-number.*?">(.*?)<\/div>/', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            // Retorna os números extraídos
            return array_map('trim', $matches[1]); // Limpa e retorna os números
        } else {
            return ["Números não encontrados"];
        }
    } catch (Exception $e) {
        return ["Erro ao buscar números: " . $e->getMessage()];
    }
}


function buscaNumerosLotomania() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/lotomania/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair os números da Lotomania
        preg_match_all('/<div class="lt-number.*?">(.*?)<\/div>/', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            // Retorna os números extraídos
            return array_map('trim', $matches[1]); // Limpa e retorna os números
        } else {
            return ["Números não encontrados"];
        }
    } catch (Exception $e) {
        return ["Erro ao buscar números: " . $e->getMessage()];
    }
}


function buscaNumerosDuplaSena() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/dupla-sena/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair o HTML específico dos sorteios da Dupla Sena
        preg_match('/<div class="lottery-single">.*?<div class="row">(.*?)<div class="winners">/s', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            return $matches[1]; // Retorna o HTML dos sorteios
        } else {
            return "Informações dos sorteios não encontradas.";
        }
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}

function buscaResultadosLoteriaFederal() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/loteria-federal/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair o HTML específico da tabela de resultados da Loteria Federal
        preg_match('/<div class="lottery-results-table">(.*?)<\/div>    <\/div>/s', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            return $matches[1]; // Retorna o HTML da tabela de resultados
        } else {
            return "Informações da Loteria Federal não encontradas.";
        }
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}


function buscaNumerosTimeMania() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/timemania/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair os números e o time favorito da Time Mania
        preg_match_all('/<div class="lt-number.*?">(.*?)<\/div>/', $html, $numberMatches);
        preg_match('/<div class="fav-team">(.*?)<\/div>/', $html, $teamMatch);

        $numeros = !empty($numberMatches[1]) ? implode(', ', $numberMatches[1]) : "Números não encontrados";
        $timeFavorito = !empty($teamMatch[1]) ? trim($teamMatch[1]) : "Time favorito não encontrado";

        return "Números: " . $numeros . "<br>Time do Coração: " . $timeFavorito;
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}


function buscaResultadosLoteca() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/loteca/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair o HTML específico dos resultados da Loteca
        preg_match('/<div class="lottery-loteca">.*?<div class="row">(.*?)<div class="winners">acumulou<\/div>.*?<\/div><\/div>/s', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            $linecards = $matches[1];

            // Substituindo quebras de linha dentro dos linecards por espaço
            $linecards = preg_replace('/<\/div>\s+<div class="/', '</div> <div class="', $linecards);

            // Substituindo quebras de linha entre os linecards por quebra de linha
            $linecards = str_replace('</div>  <div class="linecard">', '</div><br><div class="linecard">', $linecards);

            return $linecards; // Retorna o HTML ajustado dos resultados da Loteca
        } else {
            return "Informações da Loteca não encontradas.";
        }
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}



function buscaNumerosDiaDeSorte() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/dia-de-sorte/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair os números e o mês da sorte do "Dia de Sorte"
        preg_match_all('/<div class="lt-number.*?">(.*?)<\/div>/', $html, $numberMatches);
        preg_match('/<span class="month-title">Mês da Sorte: (.*?)<\/span>/', $html, $monthMatch);

        $numeros = !empty($numberMatches[1]) ? implode(', ', $numberMatches[1]) : "Números não encontrados";
        $mesSorte = !empty($monthMatch[1]) ? trim($monthMatch[1]) : "Mês da sorte não encontrado";

        return "Números: " . $numeros . "<br>Mês da Sorte: " . $mesSorte;
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}


function buscaResultadosSuperSete() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://noticias.uol.com.br/loterias/super-sete/');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair o HTML específico dos resultados do "Super Sete"
        preg_match('/<div class="lottery-single">.*?<div class="row">(.*?)<div class="winners">acumulou<\/div>.*?<\/div><\/div>/s', $html, $matches);
        if (!empty($matches) && !empty($matches[1])) {
            $resultados = $matches[1];
            // Substituindo div por span
            $resultados = str_replace('<div class="lt-number', '<span class="lt-number', $resultados);
            $resultados = str_replace('</div>', '</span>', $resultados);
            // Adicionando espaço, hífen e espaço após cada fechamento de tag span
            $resultados = str_replace('</span>', '</span> - ', $resultados);
            // Removendo a palavra "acumulou"
            $resultados = str_replace('acumulou', '', $resultados);
            return $resultados; // Retorna o HTML ajustado dos resultados do "Super Sete"
        } else {
            return "Informações do Super Sete não encontradas.";
        }
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}



function buscaTabelasJogoDoBicho() {
    $client = new GuzzleHttp\Client();
    try {
        $response = $client->request('GET', 'https://www.resultadofacil.com.br/deunoposte-rj-de-hoje');
        $html = $response->getBody()->getContents();

        // Expressão regular para extrair as tabelas dos resultados do jogo do bicho
        preg_match_all('/<table class=".*?" id=".*?".*?>.*?<\/table>/s', $html, $matches);
        $tabelas_html = implode("\n", $matches[0]); // Concatena todas as tabelas encontradas

        if (!empty($tabelas_html)) {
            return $tabelas_html; // Retorna todas as tabelas HTML dos resultados do jogo do bicho
        } else {
            return "Tabelas do jogo do bicho não encontradas.";
        }
    } catch (Exception $e) {
        return "Erro ao buscar informações: " . $e->getMessage();
    }
}


