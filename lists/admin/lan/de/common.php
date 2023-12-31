<?php

# file with common texts for translation

# main page & navigation texts

$lan = array(
  'logout' => 'Logout',
  'Main Page' => 'Hauptseite',
  'user' => 'Abonnent',
  'error' => 'Fehler',
  'version' => 'Version',
  'powered by' => 'powered by',
  'fatalerror' => 'Fehler',
  'warning' => 'Warnung',
  'information' => 'Information',
  'help' => 'Hilfe',
  'about' => '&Uuml;ber',
  'lists' => 'Listen',
  'send a message' => 'Nachricht erstellen',
  'users' => 'Abonnenten',
  'manage users' => 'Abonnenten verwalten',
  'messages' => 'Nachrichten',
  'statistics' => 'Statistik',
  'process queue' => 'Warteschlange verarbeiten',
  'configure' => 'Konfiguration',
  'Subscribe Pages' => 'Anmeldeseiten',
  'Send a prepared message' => 'Auf einer Vorlage basierende Nachricht erstellen',
  'Prepare a message' => 'Nachrichtenvorlage erstellen',
  'Templates' => 'Templates',
  'View Bounces' => 'Nicht zustellbare Mails verarbeiten',
  'Process Bounces' => 'Nicht zustellbare Mails abholen',
  'Eventlog' => 'Eventlog',
  'Sunday' => 'Sonntag',
  'Monday' => 'Montag',
  'Tuesday' => 'Dienstag',
  'Wednesday' => 'Mittwoch',
  'Thursday' => 'Donnerstag',
  'Friday' => 'Freitag',
  'Saturday' => 'Samstag',
  'January' => 'Januar',
  'February' => 'Februar',
  'March' => 'M&auml;rz',
  'April' => 'April',
  'May' => 'Mai',
  'June' => 'Juni',
  'July' => 'Juli',
  'August' => 'August',
  'September' => 'September',
  'October' => 'Oktober',
  'November' => 'November',
  'December' => 'Dezember',
  'Jan' => 'Jan',
  'Feb' => 'Feb',
  'Mar' => 'M&auml;r',
  'Apr' => 'Apr',
  'shortMay' => 'Mai',
  'Jun' => 'Jun',
  'Jul' => 'Jul',
  'Aug' => 'Aug',
  'Sep' => 'Sep',
  'Oct' => 'Okt',
  'Nov' => 'Nov',
  'Dec' => 'Dez',
  # from sendemaillib
  'sendingtextonlyto' => 'Sende Text nur an',
  'sendingmessage' => 'Sende Nachricht',
  'withsubject' => 'mit Betreff',
  'to' => 'an',
  'admininitfailure' => 'Admin Authentication Initialisation ist fehlgeschlagen',
  'yourpassword' => 'Ihr Passwort f&uuml;r PHPlist',
  'yourpasswordis' => 'Ihr Passwort ist',
  'passwordsent' => 'Ihr Passwort wurde per E-Mail verschickt.',
  'cannotsendpassword' => 'Das Passwort konnte nicht verschickt werden.',
  'ipchanged' => 'Ihre IP-Adresse hat ge&auml;ndert. Aus Sicherheitsgr&uuml;nden m&uuml;ssen Sie sich erneut anmelden.',
  'goodbye' => 'Auf Wiedersehen',
  'goodmorning' => 'Guten Morgen',
  'goodafternoon' => 'Guten Tag',
  'goodevening' => 'Guten Abend',
  'safemodewarning' => 'Im Safe Mode wird nicht alles so funktionieren wie erwartet.',
  'magicquoteswarning' => 'Das System arbeitet besser mit <strong>PHP magic_quotes_gpc = on</strong>.',
  'magicruntimewarning' => 'Das System arbeitet besser mit <strong>PHP magic_quotes_runtime = off</strong>.',
  'noxml' => 'Sie versuchen RSS zu nutzen, aber XML ist in Ihrer PHP-Installation nicht enthalten.',
  'warnopenbasedir' => 'Es ist eine open_basedir-Direktive aktiv. M&ouml;glicherweise ist sie die Ursache f&uuml;r die folgende Warnung.',
  'warnattachmentrepository' => 'Die Ablage f&uuml;r Attachments existiert nicht oder erlaubt keinen Schreibzugriff.',
  'nofpdf' => 'Sie versuchen die PDF-Unterst&uuml;tzung zu nutzen, ohne FPDF geladen zu haben.',
  'warnpageroot' => 'Der Wert der Variable $pageroot in der Datei config.php entspricht nicht<br />der aktuellen Position. Bitte &uuml;berpr&uuml;fen Sie Ihre Konfiguration.',
  'pagenotfoundinplugin' => 'Diese Seite wurde im Plug-In nicht gefunden.',
  'notimplemented' => 'Diese Funktion ist noch nicht implementiert.',
  'noaccess' => 'Sie haben keine Zugriffsberechtigung f&uuml;r diese Seite.',
  'nohelpavailable' => 'Zu diesem Thema existiert noch kein Hilfetext: ',
  'closewindow' => 'Fenster schliessen',
  'success' => 'Erfolg',
  'failed' => 'Misserfolg',
  'default login is' => 'Der Standard-Benutzername lautet',
  'with password' => 'mit dem Passwort',
  'name' => 'Benutzername',
  'password' => 'Passwort',
  'enter' => 'Anmelden',
  'forgot password' => 'Haben Sie Ihr Passwort vergessen?',
  'enter your email' => 'Ihre E-Mail-Adresse',
  'send password' => 'Passwort senden',
  'An image exists on the server, check this box to keep the existing one' =>
  	'Es existiert bereits ein Bild auf dem Server. Selektieren Sie diese Checkbox, um das bestehende Bild zu behalten.',
  'View Image' => 'Bild betrachten',
  'Upload new image' => 'Neues Bild uploaden',
  'textline' => 'Text (einzeilig)',
  'textarea' => 'Text (mehrzeilig)',
  'date' => 'Datum',
  'checkbox' => 'Checkbox',
  'radio' => 'Radiobutton',
  'select' => 'Auswahl (Dropdown)',
  'checkboxgroup' => 'Checkbox-Gruppe',
  'unnamed list' => 'Unbenannte Liste',
  'unknown' => 'Unbekannt',
  'very little time' => 'sehr wenig Zeit',
  'A process for this page is already running and it was still alive' =>
  	'F&uuml;r diese Seite l&auml;uft bereits ein aktiver Prozess.',
  'seconds ago' => 'Sekunden zuvor',
  'We have been waiting too long, I guess the other process is still going ok' =>
  	'Wir haben zu lange gewartet, ich denke der andere Prozess l&auml;uft noch immer.',
  'Sleeping for 20 seconds, aborting will quit' =>
  	'Pausiere w&auml;hrend 20 Sekunden, beenden durch Abbruch',
  'No Image was found' =>
  	'Es wurde kein Bild gefunden',
  'messages' => 'Nachrichten',
  'bounces' => 'Retouren verarbeiten', // main page
  'bounce' => 'Retoure',
  'msg' => 'Nachr.', # as in short for message
  'time' => 'Zeit',
  'sent' => 'Gesendet',
  'text' => 'Text',
  'html' => 'HTML',
  #
  # new for 2.9.5
  'delete user' => 'Benutzer l&ouml;schen',
  'unconfirm user' => 'Benutzer als unbest&auml;tigt kennzeichnen',
  'delete user and bounce' => 'Benutzer l&ouml;schen and bounce',
  'unconfirm user and delete bounce' => 'Benutzer als unbest&auml;tigt kennzeichnen und unzustellbares Mail l&ouml;schen',
  'blacklist user and delete bounce' => 'Benutzer auf Blacklist setzen und  unzustellbares Mail l&ouml;schen',
  'delete bounce' => 'Unzustellbares Mail l&ouml;schen',
  'blacklist user' => 'Benutzer auf Blacklist setzen',
  'manage bounces' => 'Retouren verwalten',
  'perc' => '%',
  'invalid login from %s, tried logging in as %s' => 'Ung&uuml;ltiges Login von %s, versuchte als %s einzuloggen',
  'successful password request from %s for %s' => 'Erfolgreiche Passwort-Anforderung von %s f&uuml;r %s',
  'failed password request from %s for %s' => 'Fehlgeschlagene Passwort-Anforderung von %s f&uuml;r %s',
  'login ip invalid from %s for %s (was %s)' => 'Ung&uuml;ltige Login-IP von %s f&uuml;r %s (%s)',
  'invalidated login from %s for %s (error %s)' => 'Unvalidierter Login von %s f&uuml;r %s (Fehler %s)',
  'close' => 'Minimieren',
  'open' => 'Maximieren',
  'import is not available' => 'Import ist nicht verf&uuml;gbar',


);

?>
