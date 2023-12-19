<?php
/**
 * Plugin Name: Meu Plugin Mega Sena
 * Description: Plugin para buscar números da Mega Sena e exibir via shortcode.
 * Version: 1.0
 * Author: Seu Nome
 */

// Inclua o Autoloader do Composer
require_once __DIR__ . '/vendor/autoload.php';

// Inclua arquivos adicionais
require_once __DIR__ . '/includes/scraper.php';

// Função para registrar o shortcode
function meu_shortcode_megasena() {
    $numeros = buscaNumerosMegaSena();
    return implode(', ', $numeros);
}
add_shortcode('megasena-numeros', 'meu_shortcode_megasena');


function meu_shortcode_quina() {
    $numeros = buscaNumerosQuina();
    return implode(', ', $numeros);
}
add_shortcode('quina-numeros', 'meu_shortcode_quina');


function meu_shortcode_lotofacil() {
    $numeros = buscaNumerosLotofacil();
    return implode(', ', $numeros);
}
add_shortcode('lotofacil-numeros', 'meu_shortcode_lotofacil');


function meu_shortcode_lotomania() {
    $numeros = buscaNumerosLotomania();
    return implode(', ', $numeros);
}
add_shortcode('lotomania-numeros', 'meu_shortcode_lotomania');


function meu_shortcode_duplasena() {
    return buscaNumerosDuplaSena();
}
add_shortcode('duplasena-numeros', 'meu_shortcode_duplasena');


function meu_shortcode_loteriafederal() {
    return buscaResultadosLoteriaFederal();
}
add_shortcode('loteriafederal-resultados', 'meu_shortcode_loteriafederal');


function meu_shortcode_timemania_numeros() {
    return buscaNumerosTimeMania();
}
add_shortcode('timemania-numeros', 'meu_shortcode_timemania_numeros');



function meu_shortcode_loteca() {
    return buscaResultadosLoteca();
}
add_shortcode('loteca-resultados', 'meu_shortcode_loteca');



function meu_shortcode_diadesorte() {
    return buscaNumerosDiaDeSorte();
}
add_shortcode('diadesorte-numeros', 'meu_shortcode_diadesorte');


function meu_shortcode_supersete() {
    return buscaResultadosSuperSete();
}
add_shortcode('supersete-resultados', 'meu_shortcode_supersete');



function meu_shortcode_jogodobicho() {
    return buscaResultadosJogoDoBicho();
}
add_shortcode('jogodobicho-resultados', 'meu_shortcode_jogodobicho');



function meu_shortcode_jogodobicho_tabelas() {
    return buscaTabelasJogoDoBicho();
}
add_shortcode('jogodobicho-tabelas', 'meu_shortcode_jogodobicho_tabelas');


