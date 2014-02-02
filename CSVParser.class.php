<?
class CSVParser{

    private $handle = null;
    
    private $data = array();
    
    private $fields = array();
    
    private $counter = 0;
    
    private $csv = null;
    
    private $wordIndex = array();
    
    public function __construct($csv){
        if($csv){
            $this->csv = $csv;
            $this->load();
        }
        $this->wordIndex();
    }
    
    private function load(){
        $this->handle = @fopen($this->csv, 'r');
        if($this->handle){
            while(($this->row = fgetcsv($this->handle, 4096, ';')) !== false){
                if(empty($this->fields)){
                    $this->fields = $this->row;
                    continue;
                }
                foreach($this->row as $key => $value){
                    $this->data[$this->counter][$key] = $value;
                }
                $this->counter++;
            }
            if(!feof($this->handle)){
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($this->handle);
        }
    }
    
    public function getData(){
        return $this->wordIndex;
    }
    
    private function wordIndex(){
        foreach($this->data as $word){
            $this->wordIndex[strtoupper($word[1])] = $word;
        }
    }
}
?>