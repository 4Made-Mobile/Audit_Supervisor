<?php
// Configura o horário do PHP para a hora de SP.
date_default_timezone_set('America/Sao_Paulo');

// Rotas da Autenticação
Route::get('/login', 'LoginController@form');
Route::post('/login', 'LoginController@login');
Route::get('/verifica', 'LoginController@verifica');
Route::get('/logout', 'LoginController@logout');

// Rotas superficiais
Route::get('/', 'HomeController@index');

// Rotas relacionadas ao cliente
Route::get('/cliente/novo/', 'ClienteController@novo');
Route::get('/cliente/lista-geral/', 'ClienteController@listaGeral');
Route::post('/cliente/adiciona', 'ClienteController@adiciona');
Route::post('/cliente/altera', 'ClienteController@altera');
Route::get('/cliente/mostra/{id}', 'ClienteController@mostra');
Route::get('/cliente/edita/{id}', 'ClienteController@edita');
Route::get('/cliente/remove/{id}', 'ClienteController@remove');

// Rotas relacionadas ao supervisor
Route::get('/supervisor/novo/', 'SupervisorController@novo');
Route::get('/supervisor/lista-geral/', 'SupervisorController@listaGeral');
Route::post('/supervisor/adiciona', 'SupervisorController@adiciona');
Route::post('/supervisor/altera', 'SupervisorController@altera');
Route::get('/supervisor/mostra/{id}', 'SupervisorController@mostra');
Route::get('/supervisor/edita/{id}', 'SupervisorController@edita');
Route::get('/supervisor/remove/{id}', 'SupervisorController@remove');


// Rotas relacionadas ao usuário->supervisor
Route::get('/usuario/lista-geral/', 'UsuarioController@listaGeral');
Route::post('/usuario/altera', 'UsuarioController@altera');
Route::get('/usuario/edita/{id}', 'UsuarioController@edita');
Route::get('/usuario/imei/{id}', 'UsuarioController@imei');

// Rotas relacionadas ao vendedor
Route::get('/vendedor/novo/', 'VendedorController@novo');
Route::get('/vendedor/lista-geral/', 'VendedorController@listaGeral');
Route::post('/vendedor/adiciona', 'VendedorController@adiciona');
Route::post('/vendedor/altera', 'VendedorController@altera');
Route::get('/vendedor/mostra/{id}', 'VendedorController@mostra');
Route::get('/vendedor/edita/{id}', 'VendedorController@edita');
Route::get('/vendedor/remove/{id}', 'VendedorController@remove');

// Rotas relacionadas ao formulário
Route::get('/formulario/novo/', 'FormularioController@novo');
Route::get('/formulario/adiciona/', 'FormularioController@adiciona');
Route::get('/formulario/finalizar/', 'FormularioController@finalizar');
Route::get('/formulario/altera-formulario/', 'FormularioController@alteraFormulario');
Route::get('/formulario/lista-pergunta/', 'FormularioController@listaPergunta');
Route::get('/formulario/remove-pergunta/', 'FormularioController@removePergunta');
Route::get('/formulario/cria-formulario/', 'FormularioController@criaFormulario');
Route::get('/formulario/cria-pergunta/', 'FormularioController@criaPergunta');
Route::get('/formulario/lista-geral/', 'FormularioController@listaGeral');
Route::get('/formulario/remove/{id}', 'FormularioController@remove');

// FEEDBACK
Route::get('/feedback/lista-geral', 'FeedbackController@listaGeral');
Route::get('/feedback/edita', 'FeedbackController@edita');
Route::get('/feedback/relatorio', 'FeedbackController@relatorio');

// Visitas Base e Pesquisa
Route::get('/visita/novo/', 'VisitaController@novo');
Route::get('/visita/lista-geral/', 'VisitaController@listaGeral');
Route::post('/visita/adiciona/', 'VisitaController@adiciona');
Route::get('/visita/mostra/{id}', 'VisitaController@mostra');
Route::get('/visita/pesquisa/{id}', 'VisitaController@pesquisa');
Route::get('/visita/remove/{id}', 'VisitaController@remove');
Route::get('/visita/relatorio/{id}', 'VisitaController@relatorio');

##################################################
#### CUIDADO AO MEXER! PODE PARAR O APLICATIVO ###
##################################################

Route::get('/webservice/login/', 'WebServiceController@verificaLogin');
Route::get('/webservice/lista-visita/', 'WebServiceController@listaVisita');
Route::get('/webservice/respostas/', 'WebServiceController@resposta');
Route::get('/webservice/feedback/', 'WebServiceController@feedback');