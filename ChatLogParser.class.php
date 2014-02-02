<?
class ChatLogParser{

    private $clines = array();
    
    private $path = null;
    
    private $content = null;
    
    public $users = array();
    
    public $numLines = 0;
    
    public $numFinalLines = 0;
    
    public $numFilteredLines = 0;
	
	public $filteredLines = array();
    
    public $numErrorLines = 0;
    
    public $numMultipleLines = 0;
    
    private $channelRegEx = '/\[\d*\.*\s*\w*\]*/';
    
    private $currentLine = null;
    
    private $parts = null;
    
    private $stripChannel = true;
    
    public $words = array();
    
    public $numWords = 0;
    
    private $trimString = ' ,:.!_-"&()+;/[]|?\'<>#=%*Ø°';
	
	private $noWord = array('/\d+\/{1}\d+/','/\d+\-{1}\d+/','/\d{2}:{1}\d{2}$/');
    
    private $lines = array();   
    
    public function __construct($path){
        $this->path = $path;
        $this->loadFile();
        $this->parse();
        $this->numFinalLines = $this->numFinalLines-$this->numMultipleLines;
        usort($this->words,function($a,$b){return $b['count'] - $a['count'];});
    }
    
    private function loadFile(){
        $file = fopen($this->path,'r');
        while(!feof($file)){
            $this->clines[] = fgets($file);
            $this->numLines++;
        }
        fclose($file);
    }
    
    private function getContentAsArray(){
        return $this->clines;
    }
    
    private function isChannel(){
        if(preg_match($this->channelRegEx, $this->currentLine)){
            return true;
        }
        return;
    }
    
    private function analyseCurrentLine(){
        $string = null;
        foreach($this->parts as $part){
            if($part != $this->parts[0]){
                $string .= $part.' ';
            }
        }
        if($this->stripChannel){
            $string = trim(preg_replace($this->channelRegEx, '', $string));
        }
        if(!in_array($string, $this->lines)){
            $this->lines[] = $string;
            $this->numMultipleLines++;
        }else{
            return;
        }
        
        $words = explode(' ',$string);
        foreach($words as $word){
            if($word == $words[0]){
                $user = trim($word,' :');
                if(!in_array($user,$this->users)){
                    array_push($this->users,$user);
                }
            }else{
				if(preg_match('\[{1}[\w\d-]*\]{1}', $word)){
					$word = trim($word,'[]');
				}
                $word = trim(preg_replace('/\{{1}[a-zA-Z\ä\Ä]{1,15}\}{1}/', '', trim($word,$this->trimString)),'{}');
                if($word == '') continue;
                if(preg_match('/^\d*\.*?,*?\d*?k*?x*?$/', $word)) continue;
				if(preg_match($this->noWord[0], $word)) continue;
				if(preg_match($this->noWord[1], $word)) continue;
                if(preg_match($this->noWord[2], $word)) continue;
                $this->numWords++;
                if(!array_key_exists(strtoupper($word), $this->words)){
                    $this->words[strtoupper($word)] = array('count' => 1, 'word' => strtoupper($word),'line' => $this->currentLine);
                }else{
                    $this->words[strtoupper($word)]['count']++;
                }
            }
        }
    }
    
    private function parse(){
        foreach($this->getContentAsArray() as $this->currentLine){
            if($this->isChannel()){
                $this->numFinalLines++;
                $this->parts = explode('  ',$this->currentLine);
                if(count($this->parts) >= 2){
                    $this->analyseCurrentLine();
                }else{
                    $this->numErrorLines++;
                }
            }else{
				$this->filteredLines[] = $this->currentLine;
                $this->numFilteredLines++;
            }
        }
    }
}
?>
