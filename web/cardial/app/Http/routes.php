<?php

// AUTH
Route::get('/login', 'LoginController@form');
Route::post('/login', 'LoginController@login');
Route::get('/verifica', 'LoginController@verifica');
Route::get('/logout', 'LoginController@logout');

//HOME
Route::get('/', 'HomeController@index');
Route::get('/suporte', function() {
    return "suporte";
});

// CLIENTE
Route::get('/cliente/novo/', 'ClienteController@novo');
Route::get('/cliente/lista-geral/', 'ClienteController@listaGeral');
Route::post('/cliente/adiciona', 'ClienteController@adiciona');
Route::post('/cliente/altera', 'ClienteController@altera');
Route::get('/cliente/mostra/{id}', 'ClienteController@mostra');
Route::get('/cliente/edita/{id}', 'ClienteController@edita');
Route::get('/cliente/remove/{id}', 'ClienteController@remove');

// SUPERVISORES
Route::get('/supervisor/novo/', 'SupervisorController@novo');
Route::get('/supervisor/lista-geral/', 'SupervisorController@listaGeral');
Route::post('/supervisor/adiciona', 'SupervisorController@adiciona');
Route::post('/supervisor/altera', 'SupervisorController@altera');
Route::get('/supervisor/mostra/{id}', 'SupervisorController@mostra');
Route::get('/supervisor/edita/{id}', 'SupervisorController@edita');
Route::get('/supervisor/remove/{id}', 'SupervisorController@remove');

// VENDEDORES
Route::get('/vendedor/novo/', 'VendedorController@novo');
Route::get('/vendedor/lista-geral/', 'VendedorController@listaGeral');
Route::post('/vendedor/adiciona', 'VendedorController@adiciona');
Route::post('/vendedor/altera', 'VendedorController@altera');
Route::get('/vendedor/mostra/{id}', 'VendedorController@mostra');
Route::get('/vendedor/edita/{id}', 'VendedorController@edita');
Route::get('/vendedor/remove/{id}', 'VendedorController@remove');

// PERGUNTA
Route::get('/pergunta/novo/', 'PerguntaController@novo');
Route::get('/pergunta/lista-geral/', 'PerguntaController@listaGeral');
Route::post('/pergunta/adiciona', 'PerguntaController@adiciona');
Route::post('/pergunta/altera', 'PerguntaController@altera');
Route::get('/pergunta/mostra/{id}', 'PerguntaController@mostra');
Route::get('/pergunta/edita/{id}', 'PerguntaController@edita');
Route::get('/pergunta/remove/{id}', 'PerguntaController@remove');

// Visitas Base e Pesquisa
Route::get('/visita/novo/', 'VisitaController@novo');
Route::get('/visita/lista-geral/', 'VisitaController@listaGeral');
Route::post('/visita/adiciona/', 'VisitaController@adiciona');
Route::get('/visita/mostra/{id}', 'VisitaController@mostra');
Route::get('/visita/pesquisa/{id}', 'VisitaController@pesquisa');
Route::get('/visita/remove/{id}', 'VisitaController@remove');
Route::get('/visita/relatorio/{id}', 'VisitaController@relatorio');

// WEBSERVICE
Route::get('/webservice/login/', 'WebServiceController@verificaLogin');
Route::get('/webservice/lista-visita/', 'WebServiceController@listaVisita');


