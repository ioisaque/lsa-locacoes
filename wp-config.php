<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'lsalocac_base');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ijvl&P-Z-YXgd-5ws^P^>NLcIa|Ih0=+Z(;&m@n{J5c7X{Fw&V&K<3MkD6E3x(Nt');
define('SECURE_AUTH_KEY',  'kWAqv]ondf[eK!INEWvTg{fKl>&G|zsRT:w)^).fLz{:CsRGYmom`uHO(JlfQf`=');
define('LOGGED_IN_KEY',    'zY_A: wpHYpw}%/2uaPWbN6@Vp6TyE(izRBKxG&^&WdlMuR))V]2Rh;c6.J/AU):');
define('NONCE_KEY',        'Hc@aZikhWd7q`Gx(t/(*r<[8gqEN)U3J<sZhm#woN1[1*op:+8OPsZF#3F]3BN:>');
define('AUTH_SALT',        'iH>gPGPf/%wLVa`+}};Uju#v,I168q#v!PNqU:tp_GcA<&[SW:@$M~)ka|?<<oVV');
define('SECURE_AUTH_SALT', '15k[!C@*C6yd}[JCHPUdtEn<NGQ WG-XD=*d+$J7_4]y]_|^n>Rrle$ztQ.sr%T4');
define('LOGGED_IN_SALT',   '6W%0g(~FnV=$)]8mBpEkHz*Ds:{p(`f0A3_b`*;jCNXSuUm45s|=nBsav1r?DA_-');
define('NONCE_SALT',       'S9HH-wP$,^K|fPqB:TGo1nQ~:NMWT|S <Ngu(^uHJ$>(N7{f/*8Ee9n{hd)$YaSR');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
