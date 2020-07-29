<?php
/*
 * conține tot textul static găsit în aplicație.
 * Orice text afișat în aplicație poate fi modificat modificând variabila matrică relevantă $ lang [].
 * DECLARATION: Google translation is used to make all the translations
 */

// Application heading
$lang['page_title'] = 'W1 Muzica';
$lang['total_active_artists'] = 'Total Artisti Activi: ';
$lang['total_songs'] = ' Cantece Totale: ';

/*
 * Intrări de text pentru pagina de pornire
 */

$lang['main_heading'] = 'Bine ati venti pe pagina principala';
$lang['home_description'] = 'Aceasta este pagina de pornire a aplicației muzicale W1 care preia date despre diverși artiști si melodiile lor. Datele sunt stocate în siguranța pe serverul MySQL. Recuperarea datelor este posibila prin intermediul limbajului de programare PHP';

/*
 * Intrări de text pentru pagina artiștilor
 */
$lang['artist_name'] = 'Numele Artistului';
$lang['no_of_songs'] = 'Numar De Cantece';
$lang['artist_heading'] = 'Bine ati venit la Pagina Artistului';
$lang['artist_description'] = ''; // păstrând această intrare pentru consecvența stilului și dacă cerințele se schimbă în viitor pentru a adăuga o descriere

/*
 * Intrări de text pentru paginile melodiilor
 */

$lang['song_title'] = 'Denumirea Piesei';
$lang['song_duration'] = 'Durata  Melodiei';
$lang['song_heading'] = 'Bun Venit pe Pagina Cantecelor';
$lang['song_description'] = ''; // păstrând această intrare pentru consecvența stilului și dacă cerințele se schimbă în viitor pentru a adăuga o descriere

/*
 * Intrări de text pentru pagina de eroare
 */

$lang['error_heading'] = 'Pagina nu a fost gasita';
$lang['error_description'] = 'Oh nu! Nu putem gasi ceea ce cautați. ';
?>