<?php
/*
 * This file contains variables containing the SQL queries used in the application.
 * Any changes to the queries must be done here.
 */


// Query to retrieve active artists list
$sql['active_artist_list'] = 'select artist.name, count(song.id) as noOfSongs from artist inner join song on (artist.id = song.artist_id) where (song.id <> 0) group by artist.name';

// Query to retrieve total number of active artists
$sql['total_active_artists'] = 'select count(distinct artist.id) as noOfArtists from artist left join song on (artist.id = song.artist_id) where (song.duration > 0)';

// Query to retrieve songs list from database
$sql['songs_list'] = 'select song.title, artist.name, song.duration from artist join song on (artist.id = song.artist_id) order by artist.name,song.title ASC';

// Query to retrieve total number of songs in the database
$sql['total_songs'] = 'select count(*) as totalSongs from song';
?>