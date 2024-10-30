=== Cathopedia ===

Contributors: don Paolo Benvenuto
Donate link: http://it.cathopedia.org/wiki/Cathopedia:Donazioni
Tags: cathopedia, mediawiki, link, icon, term, description, definition
Requires at least: 2.3.0
Tested up to: 3.3.1
Stable tag: 1.4

Permette di inserire nei post e nelle pagine i collegamenti alle voci di Cathopedia (http://it.cathopedia.org) usando la stessa sintassi di Cathopedia:
- **[[**Isaia**]]** produce un collegamento alla voce Isaia di Cathopedia.
- **[[**Isaia**|**profeta Isaia**]]** produce un collegamento alla voce Isaia di Cathopedia mostrando il testo *profeta Isaia*.

== Description ==

Permette di inserire nei post e nelle pagine i collegamenti alle voci di Cathopedia (http://it.cathopedia.org) usando la stessa sintassi di Cathopedia:
- **[[**Isaia**]]** produce un collegamento alla voce Isaia di Cathopedia.
- **[[**Isaia**|**profeta Isaia**]]** produce un collegamento alla voce Isaia di Cathopedia mostrando il testo *profeta Isaia*.

Opzioni:

- Selezione della versione linguistica di  cathopedia (xy.cathopedia.org)
- Possibilità di disabilitare la generazione dei collegamenti a Cathopedia
- Possibilità di mettere il collegamento solo in un'icona dopo il testo e non nel testo stesso
- Personalizzazione dello stile css dei collegamenti a Cathopedia
- Possibilità di aggiungere l'attributo rel=nofollow ai collegamenti a Cathopedia
- Lingua supportate nell'interfaccia: per ora solo l'italiano; d'altronde Cathopedia finora esiste solo in italiano
- Possibilità di disabilitare i collegamenti in un solo post, ponendo ovunque nel post il testo **[cathoicon]**
- Possibilità di far apparire le doppie parentesi quadre invece del collegamento, usando questa sintassi: **[[**Isaia**:0]]**, che genererà "[[Isaia]]"

== Installation ==

Visit [the plugin page] (http://it.cathopedia.org/wiki/Cathopedia:Wordpress) for installation steps for the latest release of the plugin.

1. Download and extract plugin files to a folder locally.
2. Copy the entire folder *cathopedia*  to the */wp-content/plugins/* directory.
3. Enable the plugin through the *WordPress* admin interface.
4. Optionally configure the plugin from the new *Cathopedia* menu item

If you're using a new version of Wordpress you can try the automatic installation from administration panel.

== Screenshots ==

None.

== Changelog ==

= 1.0 =

* First version, based on Cristiano Fino's wikipedia-autolink.

= 1.0.1 =

* Corrected credits for compliance with GPL

= 1.1 =

* Added "?ref=wordpress" parameter to the URL so that it's easier to track visits generated from the plugin

= 1.2 =

* Changed "?ref=wordpress" parameter to '?pk_campaign=Wordpress&pk_kwd=' . $_SERVER['SERVER_NAME'] for better tracking. 

= 1.3 =

* Added the article name after the server name for better tracking. 

= 1.4 =

* Better managment of piwik campaign parameter

== Upgrade Notice ==

= 1.0 =

Initial version.

= 1.1 =

No problem

= 1.2 =

No problem

= 1.3 =

No problem

= 1.4 =

No problem

== Credits ==

- Cristiano Fino (http://www.cristianofino.net) for producing wikipedia-autolink, which was the base for this plugin
     - plugin site:                  http://www.cristianofino.net/post/Wikipedia-Autolink-plugin-anche-per-WordPress.aspx
     - plugin page on wordpress.org: http://wordpress.org/extend/plugins/wikipedia-autolink/
