
CREATE TABLE IF NOT EXISTS team  (
	id SERIAL PRIMARY KEY,
	first_name VARCHAR(64) NOT NULL DEFAULT '',
	last_name VARCHAR(64)  NOT NULL DEFAULT '',
    email varchar(100) NOT NULL DEFAULT '',
	role smallint NOT NULL DEFAULT 0,
	department varchar(100) NOT NULL DEFAULT '',
	photo VARCHAR(255) NOT NULL DEFAULT '',
	description text  NOT NULL DEFAULT '',
	created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT  CURRENT_TIMESTAMP
);

insert into team (id, first_name, last_name, email, role, department, photo, description) values (1, 'Angelo', 'Abear','angelo.abear@networld.com', 2,'CEO', 'angelo-abear-XUMb1TaojwY.jpg', 'Partial loss of teeth, unspecified cause, unspecified class');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (2, 'Barna', 'Bartis','barna.bartis@networld.com', 2,'Managing Director', 'barna-bartis-2x3vfVxwR7o.jpg', 'Animal-rider injured in other transport accident, sequela');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (3, 'Carlos', 'Magno','carlos.magno@networld.com', 2,'Founder', 'carlos-magno-sTORW_4vrwg.jpg', 'Other diseases of lip and oral mucosa');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (4, 'Christian', 'Buehner','christian.buehner@networld.com', 1,'Web Developer II', 'christian-buehner-DItYlc26zVI.jpg', 'Insect bite (nonvenomous) of left front wall of thorax');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (5, 'Xaen', 'Ascllo','xean.ascllo@networld.com', 1,'Web Developer II', 'disruptivo-Xaen-acsLLo.jpg', 'War op w explosn of sea-based artlry shell, civ, sequela');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (6, 'Dimtry', 'Vechorko', 'dimitri.vechorko@networld.com', 1,'Editor', 'dmitry-vechorko-uQP6mJ5x9Oo.jpg', 'Toxic effect of oth inorganic substances, assault, init');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (7, 'Yion', 'Lee','yion.lee@networld.com', 1, 'Editor','mister-lee-_KL3FFG4eBA.jpg', 'Other superficial bite of left upper arm');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (8, 'Ryan', 'Mill','ryan.mill@networld.com', 1,'Media Designer', 'rayan-mill-AGlO2jlVE4c.jpg', 'Herpesviral gingivostomatitis and pharyngotonsillitis');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (9, 'Yousaf', 'Usman','yousaf.usman@networld.com',1, 'Media Designer', 'usman-yousaf-isA_U8EDIZc.jpg', 'Mtrcy driver injured in nonclsn trnsp accident nontraf, subs');
insert into team (id, first_name, last_name, email, role, department, photo, description) values (10, 'Vladyslav', 'Tyzun','vladyslav/tyzun@networld.com',1, 'CEO', 'vladyslav-tyzun-B_gJt-6xK30.jpg', 'Unsp injury of posterior tibial artery, right leg, subs');

SELECT setval('public.team_id_seq', 10, true);

CREATE TABLE IF NOT EXISTS posts (
  id SERIAL PRIMARY KEY,
  post_author bigint NOT NULL DEFAULT '0',
  post_content text  NOT NULL,
  post_title text NOT NULL,
  post_excerpt text  NOT NULL,	
  post_thumb VARCHAR(255) NOT NULL DEFAULT '',
  post_status varchar(20)  NOT NULL DEFAULT 'publish',
  created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT  CURRENT_TIMESTAMP,
  constraint fk_post_author
     foreign key (post_author) 
     REFERENCES team (id)
);


insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (1, 1, 'dockerHub.jpg' ,'published', 'Docker Hub ist ein Onlinedienst, der eine Registry für Docker-Images und Repositories beinhaltet. Die Registry teilt sich in einen öffentlichen und einen privaten Teil auf. Im öffentlichen Teil kann jeder Nutzer seine selbst erstellten Images hochladen und damit anderen Nutzern zur Verfügung stellen. Außerdem gibt es mittlerweile offizielle Images, z. B. von Linux-Distributoren. Im privaten Teil von Docker Hub können Benutzer ihre Docker-Images hochladen und dadurch einfach z. B. firmenintern verteilen, ohne dass diese damit öffentlich auffindbar sind.
Die Registry-Software wurde von Docker Inc. als Open-Source-Software veröffentlicht, sodass man die Vorteile dieser nun auch nutzen kann, ohne die eigenen Images auf die Server von Docker laden zu müssen. Mittels von Docker bereitgestellter APIs lassen sich Images auch automatisch aus Repositories von GitHub oder Bitbucket erstellen.','Docker Hub', 'Docker Hub ist ein Onlinedienst, der eine Registry für Docker-Images und Repositories beinhaltet.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (2, 2, 'GitHub.jpg', 'published',  'GitHub ist ein netzbasierter Dienst zur Versionsverwaltung für Software-Entwicklungsprojekte. Namensgebend war das Versionsverwaltungssystem Git. Das Unternehmen GitHub, Inc. hat seinen Sitz in San Francisco in den USA. Seit dem 26. Dezember 2018 gehört das Unternehmen zu Microsoft. Ähnliche Dienste sind GitLab, Bitbucket und Gitee.','GitHub', 'GitHub ist ein netzbasierter Dienst zur Versionsverwaltung für Software-Entwicklungsprojekte.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (3, 3, 'typescript.jpg', 'published',  'TypeScript ist eine von Microsoft entwickelte Programmiersprache, die auf den Vorschlägen zum ECMAScript-6-Standard  basiert. Sprachkonstrukte von TypeScript, wie Klassen, Vererbung, Module und anonyme Funktionen, wurden auch in ECMAScript 6 übernommen. Der von Microsoft entwickelte TypeScript-Compiler kompiliert TypeScript-Code nach ECMA Script 3 (ES3), optional auch nach ECMA Script 5 (ES5) zu plain JavaScript. Jeder JavaScript-Code ist daher auch gültiger TypeScript-Code, sodass gängige JavaScript-Bibliotheken (wie z. B. jQuery oder AngularJS) auch in TypeScript verwendet werden können.','TypeScript', 'TypeScript ist eine von Microsoft entwickelte Programmiersprache, die auf den Vorschlägen zum ECMAScript-6-Standard  basiert.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (4, 4, 'symfony.jpg', 'published', 'Symfony wird seit 2005 unter der Führung von Fabien Potencier entwickelt. Es entstand parallel zur steigenden Popularität von Ruby on Rails und dem Wunsch nach einem ähnlichen MVC-Framework auf PHP-Basis. Symfony versucht die Konfiguration auf ein Minimum zu beschränken. Wenn keine Konfiguration dafür angegeben ist, erfolgt die Zuordnung von z. B. Models zu Datenbanktabellen über die Namensgleichheit in Singular und Plural (Konvention vor Konfiguration). Durch die Konsolenanwendung können einfache Webseiten mittels Rapid Application Development entwickelt werden.','Symfony', 'Symfony wird seit 2005 unter der Führung von Fabien Potencier entwickelt.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (5, 5, 'crud.jpg', 'published', 'Vielfach werden die einzelnen CRUD-Operationen mittels einer Persistenz-Schicht umgesetzt. Die Persistenz-Schicht hebt die relationale Repräsentation der einzelnen Informationen auf eine objektorientierte Ebene. Werden die einzelnen Daten-Objekte zudem in einer generischen GUI visualisiert, sodass jedes Objekt durch eine der genannten CRUD-Operationen manipuliert werden kann, so spricht man in diesem Kontext auch von einem CRUD-Framework. Die nachfolgende Illustration ist der Naked-Objects-Dokumentation entliehen und stellt den möglichen Aufbau eines solchen CRUD-Frameworks dar.','CRUD', 'Vielfach werden die einzelnen CRUD-Operationen mittels einer Persistenz-Schicht umgesetzt.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (6, 6, 'rest.jpg', 'published', 'Representational State Transfer (abgekürzt REST) ist ein Paradigma für die Softwarearchitektur von verteilten Systemen, insbesondere für Webservices. REST ist eine Abstraktion der Struktur und des Verhaltens des World Wide Web. REST hat das Ziel, einen Architekturstil zu schaffen, der den Anforderungen des modernen Web besser genügt. Dabei unterscheidet sich REST vor allem in der Forderung nach einer einheitlichen Schnittstelle (siehe Abschnitt Prinzipien) von anderen Architekturstilen. Der Zweck von REST liegt schwerpunktmäßig auf der Maschine-zu-Maschine-Kommunikation. REST stellt eine einfache Alternative zu ähnlichen Verfahren wie SOAP und WSDL und dem verwandten Verfahren RPC dar. Anders als bei vielen verwandten Architekturen kodiert REST keine Methodeninformation in den URI, da der URI Ort und Namen der Ressource angibt, nicht aber die Funktionalität, die der Web-Dienst zu der Ressource anbietet. Der Vorteil von REST liegt darin, dass im WWW bereits ein Großteil der für REST nötigen Infrastruktur (z. B. Web- und Application-Server, HTTP-fähige Clients, HTML- und XML-Parser, Sicherheitsmechanismen) vorhanden ist, und viele Web-Dienste per se REST-konform sind. Eine Ressource kann dabei über verschiedene Medientypen dargestellt werden, auch Repräsentation der Ressource genannt.','Rest', 'SOAP (ursprünglich für Simple Object Access Protocol) ist ein Netzwerkprotokoll...');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (7, 7, 'soap.jpg', 'published', 'SOAP (ursprünglich für Simple Object Access Protocol) ist ein Netzwerkprotokoll, mit dessen Hilfe Daten zwischen Systemen ausgetauscht und Remote Procedure Calls durchgeführt werden können. SOAP ist ein industrieller Standard des World Wide Web Consortiums (W3C).','SOAP', 'Representational State Transfer (abgekürzt REST) ist ein Paradigma für die Softwarearchitektur von verteilten Systemen, insbesondere für Webservices.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (8, 8, 'postgresql.jpg', 'published', 'PostgreSQL (englisch oft kurz Postgres genannt, ist ein freies, objektrelationales Datenbankmanagementsystem (ORDBMS). Seine Entwicklung begann in den 1980er Jahren, seit 1997 wird die Software von einer Open-Source-Community weiterentwickelt. PostgreSQL ist weitgehend konform mit dem SQL-Standard SQL:2011, d. h. der Großteil der Funktionen ist verfügbar und verhält sich wie definiert. PostgreSQL ist vollständig ACID-konform (inklusive der Data Definition Language) und unterstützt erweiterbare Datentypen, Operatoren, Funktionen und Aggregate. Obwohl sich die Entwicklergemeinde sehr eng an den SQL-Standard hält, gibt es dennoch eine Reihe von PostgreSQL-spezifischen Funktionalitäten, wobei in der Dokumentation bei jeder Eigenschaft ein Hinweis erfolgt, ob dies dem SQL-Standard entspricht, oder ob es sich um eine spezifische Erweiterung handelt. Darüber hinaus verfügt PostgreSQL über ein umfangreiches Angebot an Erweiterungen durch Dritthersteller, wie z. B. PostGIS zur Verwaltung von Geodaten.','PostgreSQL', 'Node.js ist eine plattformübergreifende Open-Source-JavaScript-Laufzeitumgebung, die JavaScript-Code außerhalb eines Webbrowsers ausführen kann.');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (9, 9, 'php.jpg', 'published', 'PHP (rekursives Akronym und Backronym für „PHP: Hypertext Preprocessor“, ursprünglich „Personal Home Page Tools“) ist eine Skriptsprache mit einer an C und Perl angelehnten Syntax, die hauptsächlich zur Erstellung dynamischer Webseiten oder Webanwendungen verwendet wird. PHP wird als freie Software unter der PHP-Lizenz verbreitet. PHP zeichnet sich durch breite Datenbankunterstützung und Internet-Protokolleinbindung sowie die Verfügbarkeit zahlreicher Funktionsbibliotheken aus.','PHP', 'PHP (rekursives Akronym und Backronym für „PHP: Hypertext Preprocessor');
insert into posts (id, post_author, post_thumb, post_status, post_content, post_title, post_excerpt) values (10, 10, 'node-js.jpg', 'published', 'Node.js ist eine plattformübergreifende Open-Source-JavaScript-Laufzeitumgebung, die JavaScript-Code außerhalb eines Webbrowsers ausführen kann. Damit kann zum Beispiel ein Webserver betrieben werden. Node.js wird in der JavaScript-Laufzeitumgebung V8 ausgeführt, die ursprünglich für Google Chrome entwickelt wurde, und bietet eine ressourcensparende Architektur, die eine besonders große Anzahl gleichzeitig bestehender Netzwerkverbindungen ermöglicht.','Node.js', 'PHP (rekursives Akronym und Backronym für „PHP: Hypertext Preprocessor');



SELECT setval('public.posts_id_seq', 10, true);

CREATE OR REPLACE VIEW public.POSTS_VIEW
 AS
 SELECT t1.id,
    t1.post_author,
    t2.first_name,
    t2.last_name,
    t1.post_content,
    t1.post_title,
    t1.post_thumb,
    t1.post_status,
    t1.post_excerpt,
    t1.created_at,
    t1.updated_at
   FROM posts t1,
    team t2
  WHERE t2.id = t1.post_author AND t1.post_status ='published';

ALTER TABLE public.POSTS_VIEW
    OWNER TO dominik;

