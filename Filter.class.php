<?
error_reporting(E_ALL);
class Filter{
    
    private $groupedWords = array();
    
	private $groups = array(
		#flüstern
			array("W","WSP","WHISPER"),
		#ratedbgs				
			array("RBG","RBGS"),
		#suche					
			array("LFM","LF","SUCHE","SUCHT","LFG","SUCHEN","GESUCHT","SUCH"),
		#heilung				
			array("HEAL","HEILER","HEALS","HEALER","HEIL"),
		#erfahrung				
			array("XP","EXP","ERFAHRUNG"),
		#kompletterfahrung		
			array("CLEAREXP","CLEARXP"),
		#verkaufe				
			array("VK","VERKAUFE","BIETE","WTS","VERK"),
		#schadensverursacher	
			array("DD","DDS","DD´S","DD'S","DD´LER"),
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
			array("MIN","MIND"),
		#plündern
			array("GELOOTET","LOOTEN"),
		#sieg
			array("WIN","WINS"),
		#heroisch
			array("HC","HERO","HEROISCH","HC´S","HCS","HEROS","HEROIC","HC'S"),
		#nicht-heroisch
			array("NHC"),
		#spezialisierung		
			array("SPEC","SPECC","SPECCS"),
		#schlachtfeld			
			array("BG","BG´S","BGS"),
		#ausrüstung				
			array("EQUIP","EQ"),
		#gegenstand				
			array("ITEMS","ITEM"),
		#itemlevel				
			array("ILVL","ITEMLVL","ITEMSTUFE","ITLVL","ILV","ITEMLEV","IVL","ITL","ILEVEL","IL"),
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
			array("VZ","VERZ","VERZAUBERKUNST"),
		#aufgabe				
			array("QUEST","QUESTS"),
		#stapel					
			array("STACK","STACKS"),
		#instanz				
			array("INI","INIS","INI´S","INNIS","INZEN"),
		#bastion
			array("BASTION","BOT"),
		#drachenseele
			array("DS","DS10"),
		#feuerlande
			array("FEUERLANDE","FIRELANDS","FL"),
		#mogu'shangewölbe
			array("MOGU","MG","MV","MOGU'SHANGEWöLBE","MG10"),
		#pechschwingenabstieg
			array("PECHSCHWINGENABSTIEG","PSA"),
		#spiel					
			array("GAME","GAMES"),
		#gesperrt				
			array("LOCK","LOCKED","GELOCKT","LOCKT"),
		#spass					
			array("JUST4FUN","J4F","J4FUN"),
		#spielinhalt
			array("CONTENT","CONTENTS"),
		#serverübergreifend		
			array("X-REALM","XREALM","CROSSREALM"),
		#erfolge				
			array("ACHIEVEMENTS","ACM'S","ACM","ACM´S"),
		#stammgruppe		
			array("STAMM","STAMMGRUPPE","STAMMGRP","STAMMS"),
		#raidstammgruppe	
			array("RAIDSTAMM","STAMMRAID","RAIDSTAMMGRUPPE"),
		#pferd				
			array("MOUNT","MOUNTS"),
		#anführer			
			array("LEADER","LEAD","LEADS"),
		#schlüssel			
			array("KEYS","KEY"),
		#juwelenschleifer
			array("JUWE","JC","JEWELCRAFTING"),
		#trinkgeld			
			array("TG","TRINKGOLD"),
		#allianz			
			array("ALLY","ALLI"),
		#arenateamkollege	
			array("ARENAMATE","ARENAMATES"),
		#imba				
			array("IMMBA","IMBA"),
		#arena-saison		
			array("SEASON","SEASONS"),
		#zufällig			
			array("RND","RANDOM"),
		#lowrbg				
			array("LOWRBG","LOW-RBG"),
		#erfolge
			array("ACHIEVEMENTS","ACV","ERFOLGE","ERFOLG"),
		#abklingzeit
			array("CD","CDS"),
		#ddspec				
			array("DD-SPEC","DD-SPECC"),
		#heilspezialisierung
			array("HEALSPEC","HEALSPECC"),
		#druide					
			array("DROOD","DRUI","DRUID","DRUIDE","DRUIDEN","DUDU"),
		#druide-gleichgewicht
			array("EULE","OWL","BOOMKIN"),
		#druide-wiederherstellung
			array("BAUM","R-DRUID","DRUIDHEAL","HDROOD","HEALDUDU","DUDU-HEAL","HEALDROOD","HEALDRUID","HEAL-DRUID","HEALDRUIDE","RDROOD","RDRUID","RDUDU","RESTO-DRUID","RESTODRUIDE","HDUDU"),
		#hexer				
			array("HEXE","HEXER","WARLOCK","WL"),
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
			array("MS","MS-WARRIOR","MSWARRI","MS-WARRI"),
		#magier				
			array("MAGIER","MAGE","MAGES"),
		#magier-frost		
			array("FMAGE","FROSTMAGE","FROST-MAGE"),
		#mönch				
			array("MÖNCH","MONK"),
		#mönch-nebelwirker	
			array("HEALMONK","HEAL-MONK","HMONK","MONKHEAL"),
		#mönch-windwirker
		#paladin			
			array("PALA","PALADIN","PALLY"),
		#paladin-vergeltung
			array("RETRI","RETRI-PALLY"),
		#paladin-heilig		
			array("HOLYPALLY","PALAHEILER","PALAHEAL","HEALPALA","HOLYPALA","HOLYPALADIN","HPALA","H-PALA","HPALADIN","HPALLY","HPALY","PALA-HEAL","HPAL"),
		#priester-disziplin			
			array("DISC","DISZ","DISZI","DIZI"),
		#priester-schatten
			array("SCHADOW","SHADOWPRIEST","SPRIEST","SHADOW-PRIEST"),
		#priester-heilig
			array("HOLYPRIEST","HOLY-PRIEST"),
		#schamane
			array("SCHAMANE","SCHAMI","SHAM","SHAMAN","SHAMI","SHAMIE","SHAMY","SCHAMY"),
		#schamane-verstärker
			array("ENHANCER","ENH"),
		#schamane-elementar
			array("ELE","ELESHAMI","ELESCHAMI","ELE-SCHAMI"),
		#schamane-wiederherstellung
			array("SCHAMIEHEAL","RESTOSHAMI","HSCHAMI","RSCHAMAN","HEALSHAMAN","RSCHAMIE","HEALSCHAMANE","HEALSCHAMI","HEILSCHAMI","RESTOSHAMAN","RESTOSHAMY","RSCHAMI","RSHAM","RSHAMAN","RSHAMI","RSHAMY","SCHAMANE-HEAL"),
		#schurke
			array("ROGUE","ROUGE","SCHURKE","SCHURKEN"),
		#schutzklasse
			array("TANK","TANKS"),
		#todesritter-frost
			array("FDK","FROSTDK","F-DK","FROST-DK"),
		#todesritter-unheilig
			array("UNHOLY","UNHOLYDK","UDK")
	);
	
	private $groupIndex = array();
    
    private $words = array();
	
	public function __construct(){
		foreach($this->groups as $key => $words){
			foreach($words as $word){
				$this->groupIndex[$word] = $key;
			}
		}
	}
	
	public function group($words){
		foreach($words as $key => $data){
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