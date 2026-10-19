<?php
/**
 * Obsah offline stránky (modul pwa ji vypíše mezi get_header() a get_footer(), když soubor existuje).
 * Seznam uložených stránek doplní service worker do prvku s data-ekt-offline-list.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="wrap offline">
	<h1 class="page-title">Jste offline</h1>
	<p>Stránka se nedá načíst, protože zařízení není připojené k internetu. Zkuste to znovu, až bude připojení zpět.</p>
	<p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Zkusit znovu</a></p>
	<div data-ekt-offline-list></div>
</div>
