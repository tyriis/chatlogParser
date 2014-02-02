<?
class Filter{
    
    private $groupedWords = array();
    
	private $groups = array(
		#flüstern
			array("W","WSP","WHISPER"),
		#ratedbgs				
			array("RBG","RBGS"),
		#suche					
			array("LFM","LF","SUCHE","SUCHT","LFG","SUCHEN","GESUCHT","LFR"),
		#heilung				
			array("HEAL","HEALS"),
		#heiler
			array("HEILER","HEALER"),
		#erfahrung				
			array("XP","EXP","ERFAHRUNG"),
		#kompletterfahrung		
			array("CLEAREXP","CLEARXP"),
		#verkaufe				
			array("VK","VERKAUFE","BIETE","WTS","VERK"),
		#schadensverursacher	
			array("DD","DDS","DD´S","DD'S","DD´LER","DD`S"),
		#bitte					
			array("PLS","PLZ","PLEASE","BITTE","PLX"),
		#gruppe					
			array("GRP","GRUPPE","GROUP"),
		#kaufe					
			array("KAUFE","WTB"),
		#teamkollege			
			array("MATE","MATES","M8"),
		#run
			array("RUN","RUNS"),
		#mindestens
			array("MIN","MIND","MINDESTENS"),
		#versuch
			array("TRY","TRYS"),
		#plündern
			array("GELOOTET","LOOTEN"),
		#beute
			array("LOOT","DROP"),
		#sieg
			array("WIN","WINS","SIEG"),
		#heroisch
			array("HC","HERO","HEROISCH","HC´S","HCS","HEROS","HEROIC","HC'S"),
		#nicht-heroisch
			array("NHC"),
		#spezialisierung		
			array("SPEC","SPECC","SPECCS"),
		#schlachtfeld			
			array("BG","BG´S","BGS"),
		#challenge-mode
			array("CM","CHALLENGEMODE","CMODES","CHM"),
		#ausrüstung				
			array("EQUIP","EQ","GEAR"),
		#gegenstand				
			array("ITEMS","ITEM"),
		#itemlevel				
			array("ILVL","ITEMLVL","ITEMSTUFE","ITLVL","ILV","ITEMLEV","IVL","ITL","ILEVEL","IL","ITEMLEV"),
		#eiltempo				
			array("RUSH","RUSHEN"),
		#vorantreiben			
			array("PUSH","PUSHEN","GEPUSHTE","GEPUSHTEN","PUSHE","PUSHT"),
		#liverating
			array("LR","LIVE","CR"),
		#gearcheck				
			array("GC","GEARC","GEARCHECK"),
		#zweitcharakter			
			array("TWINK","TWINKS"),
		#distanzkämpfer					
			array("RDD","RANGED","RANGEDD","RANGES","RANGE","RANGEDDS","RANGE-DDS"),
		#verzauberer			
			array("VZ","VERZ","VERZAUBERKUNST","VERZAUBERER","VERZAUBERUNG"),
		#lederverarbeitung
			array("LEDERER","LEDERVERARBEITUNG"),
		#aufgabe				
			array("QUEST","QUESTS"),
		#stapel					
			array("STACK","STACKS"),
		#instanz				
			array("INI","INIS","INI´S","INNIS","INZEN"),
		#bastion
			array("BASTION","BOT"),
		#drachenseele
			array("DS","DS10","DRACHENSEELE"),
		#feuerlande
			array("FEUERLANDE","FIRELANDS","FL"),
		#mogu'shangewölbe
			array("MOGU","MG","MV","MOGU'SHANGEWöLBE","MG10","MOSHU"),
		#pechschwingenabstieg
			array("PECHSCHWINGENABSTIEG","PSA"),
		#terrasse-frühling
			array("TDEF","TDF","TERASSE","TERRASSE"),
		#herz-angst
			array("HDA","HDA10"),
		#eiskronenzitadelle
			array("ICC","ICC10","ICC25"),
		#naxxramas
			array("NAXX","NAXX25"),
		#ruinen-anqirai
			array("AQ20","AQ40"),
		#twinkrun
			array("TWINKRUN","TWINKRUNS"),
		#spiel					
			array("GAME","GAMES"),
		#dalaran
			array("DALA","DALARAN"),
		#gesperrt				
			array("LOCK","LOCKED","GELOCKT","LOCKT"),
		#spass					
			array("JUST4FUN","J4F","J4FUN"),
		#spielinhalt
			array("CONTENT","CONTENTS"),
		#serverübergreifend		
			array("X-REALM","XREALM","CROSSREALM"),
		#erfolge				
			array("ACHIEVEMENTS","ACM'S","ACM","ACM´S","ACV","ERFOLGE","ERFOLG"),
		#stammgruppe		
			array("STAMM","STAMMGRUPPE","STAMMGRP","STAMMS"),
		#raidstammgruppe	
			array("RAIDSTAMM","STAMMRAID","RAIDSTAMMGRUPPE"),
		#gildenstammgruppe
			array("GILDENSTAMM","GILDENSTAMMGRUPPE"),
		#fortschritt
			array("PROGRESS","FORTSCHRITT"),
		#pferd				
			array("MOUNT","MOUNTS"),
		#anführer			
			array("LEADER","LEAD","LEADS"),
		#schlüssel			
			array("KEYS","KEY"),
		#punkte
			array("PKT","POINTS"),
		#raid
			array("RAID","RAIDS","SCHLACHTZÜGE"),
		#noob
			array("NAPS","NOOBS","BOBS"),
		#spielen
			array("ZOCKEN","DADDELN"),
		#juwelenschleifer
			array("JUWE","JC","JEWELCRAFTING","SCHLEIFER","JUWELENSCHLEIFEN"),
		#trinkgeld			
			array("TG","TRINKGOLD","TASCHENGOLD"),
		#lederverarbeitung
			array("LEDERER","LEDERVERARBEITUNG"),
		#schneiderei
			array("TAILORING","SCHNEIDER","SCHNEIDEREI"),
		#allianz			
			array("ALLY","ALLI","ALLIANZ"),
		#arenateamkollege	
			array("ARENAMATE","ARENAMATES"),
		#imba				
			array("IMMBA","IMBA"),
		#inschriftenkunde
			array("INSCHRIFTLER","INSCHRIFTENKUNDE"),
		#schmiedekunst
			array("SCHMIEDEKUNST","SCHMIED","BLACKSMITHING"),
		#sonnenbrunnenplateau
			array("SUNWELL","SONNENBRUNNENPLATEAU"),
		#second
			array("SECOND","SECC","SEC"),
		#arena-saison		
			array("SEASON","SEASONS","SAISON"),
		#zufällig			
			array("RND","RANDOM"),
		#lowrbg				
			array("LOWRBG","LOW-RBG"),
		#abklingzeit
			array("CD","CDS"),
		#levelbereich
			array("LVLBEREICH","LVL-BEREICH"),
		#ddspec				
			array("DD-SPEC","DD-SPECC"),
		#zugang
			array("ACC","ACCOUNT","ACCOUNTS"),
		#add
			array("ADD","ADDITIONAL"),
		#verstärkung
			array("BOOST","BOOSTS"),
		#daily
			array("DAILY","DAILYS"),
		#ausgerüstet
			array("EQUIPPED","EQUIPTE","GEARED","GEGEART"),
		#gladiator
			array("GLAD","GLADI"),
		#gildenstufe
			array("GILDENLEVEL","G-STUFE"),
		#einladen
			array("INV","INVITE"),
		#jemand
			array("JEM","JMD","JMND","JEMAND","JEMANDEN"),
		#stufe
			array("LEVEL","LVL"),
		#stufenaufstieg
			array("LEVELN","LVLN"),
		#scholomance
			array("SCHOLO","SCHOLOMANCE"),
		#stylegear
			array("STYLE","STYLEGEAR"),
		#stylerun
			array("STYLEGEARRUN","STYLERUN"),
		#alchemie
			array("ALCHEMY","ALCHEMIE","ALCHI"),
		#transmutationsalchemist
			array("TRANSALCHI","TRANSMU","TRANSMUTATIONS-ALCHI"),
		#heilspezialisierung
			array("HEALSPEC","HEALSPECC"),
		#druide					
			array("DUDU","DRUID","DRUIDE","DROOD","DRUIDEN"),
		#druide-wildheit
			array("FERAL","KITTY","KATZE"),
		#druide-gleichgewicht
			array("EULE","OWL","BOOMKIN","MOONKIN"),
		#druide-wiederherstellung
			array("HEILDRUIDE","RDRUID","DUDU-HEAL","HEALDROOD","HEALDRUID","RDUDU","HEALDRUIDE","RDROOD","RESTO-DRUID","BAUM","RESTODRUIDE","DRUIDHEAL","HDUDU","HDROOD","HEALDUDU","HDRUID"),
		#hexer				
			array("HEXER","WARLOCK","WL","HEXENMEISTER"),
		#hexer-gebrechen
			array("AFFLI","DOTLOCK"),
		#hexer-zerstörung	
			array("DESTO","DESTRO","DESTRU"),
		#jäger				
			array("HUNTER","JÄGER"),
		#klasse-wiederherstellung
			array("RESTO","RESTRO"),
		#krieger			
			array("KRIEGER","WARR","WARRI","WARRIOR","WARRY"),
		#krieger-furor
			array("FURY","FUROR"),
		#krieger-ms
			array("MS","MS-WARRIOR","MSWARRI","MS-WARRI","WAFFENKRIEGER"),
		#magier				
			array("MAGIER","MAGE","MAGES"),
		#magier-frost		
			array("FMAGE","FROSTMAGE","FROST-MAGE"),
		#mönch				
			array("MÖNCH","MONK"),
		#mönch-nebelwirker	
			array("HEALMONK","HEAL-MONK","HMONK","MONKHEAL","MW-MONK"),
		#paladin			
			array("PALA","PALADIN","PALLY"),
		#paladin-schutz
			array("PROT","TANKPALA"),
		#paladin-vergeltung
			array("RETRI","RETRI-PALLY"),
		#paladin-heilig		
			array("HOLYPALLY","PALAHEILER","PALAHEAL","HEALPALA","HOLYPALA","HOLYPALADIN","HPALA","H-PALA","HPALADIN","HPALLY","HPALY","PALA-HEAL","HPAL"),
		#priester
			array("PRIEST","PRIESTER"),
		#priester-disziplin			
			array("DISC","DISZ","DISZI","DIZI"),
		#priester-schatten
			array("SHADOW","SCHADOW","SHADOWPRIEST","SPRIEST","SHADOW-PRIEST","SP"),
		#priester-heilig
			array("HOLYPRIEST","HOLY-PRIEST"),
		#schamane
			array("SCHAMANE","SCHAMI","SHAM","SHAMAN","SHAMI","SHAMIE","SHAMY","SCHAMY","SCHAMIE"),
		#schamane-verstärker
			array("ENHANCER","ENH","VERSTäRKER"),
		#schamane-elementar
			array("ELE","ELESHAMI","ELESCHAMI","ELE-SCHAMI"),
		#schamane-wiederherstellung
			array("RESTOSCHAMI","SCHAMIEHEAL","RESTOSHAMI","HSCHAMI","RSCHAMAN","HEALSHAMAN","RSCHAMIE","HEALSCHAMANE","HEALSCHAMI","HEILSCHAMI","RESTOSHAMAN","RESTOSHAMY","RSCHAMI","RSHAMAN","RSHAMI","RSHAMY","SCHAMANE-HEAL"),
		#schurke
			array("ROGUE","ROUGE","SCHURKE","SCHURKEN"),
		#schutzklasse
			array("TANK","TANKS"),
		#todesritter-frost
			array("FDK","FROSTDK","F-DK","FROST-DK"),
		#todesritter-unheilig
			array("UNHOLY","UNHOLYDK","UDK","UH"),
		#arenakombi-2
			array("2O2","2ON2","2V2","2VS2","2S"),
		#arenakombi-3
			array("3N3","3O3","3ON3","3S","3V3","3VS3"),
		#arenakombi-5
			array("5ON5","5S","5V5","5VS5","5O5")

	);
	
	private $groupIndex = array();
    
    private $words = array();
    
    private $mergeCSV = null;
    
    private $csvData = null;
	
	public function __construct($mergeCSV=false){
        $this->mergeCSV = $mergeCSV;
		foreach($this->groups as $key => $words){
			foreach($words as $word){
				$this->groupIndex[$word] = $key;
			}
		}
	}
	
	public function group($words){
        if($this->mergeCSV){
            require('CSVParser.class.php');
            $csv = new CSVParser('wortschatzeinordnung.csv');
            $this->csvData = $csv->getData();
        }
		foreach($words as $key => $data){
            if($this->mergeCSV){
                if(isset($this->csvData[$data['word']])){
                    $data['options'] = $this->csvData[$data['word']];
                }
            }
            $group = $this->getGroupKeyByWord($data['word']);
            if($group > -1){
                if(isset($this->groupedWords[$group])){
                    $this->groupedWords[$group]['count'] = $this->groupedWords[$group]['count']+$data['count'];
                    $this->groupedWords[$group]['words'][] = $data;
                }else{
                    $this->groupedWords[$group] = array(
                        'count' => $data['count'],
                        'words' => array($data)
                    );
                }
            }else{
                $this->words[] = $data;
            }
		}
        foreach($this->words as $data){
            $this->groupedWords[] = array(
                'count' => $data['count'],
                'words' => array($data)
            );
        }
        usort($this->groupedWords,function($a,$b){return $b['count'] - $a['count'];});
        return $this->groupedWords;
	}
	
	public function getGroupByKey($key){
		return $this->groups[$key];
	}
	
	public function getGroupKeyByWord($word){
		return isset($this->groupIndex[$word]) ? $this->groupIndex[$word] : false;
	}
}
?>